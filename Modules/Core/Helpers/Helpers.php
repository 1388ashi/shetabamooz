<?php


namespace Modules\Core\Helpers;


use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Image;
use JetBrains\PhpStorm\NoReturn;
use Modules\Language\Entities\Language;
use Modules\Service\Entities\Service;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Helpers
{
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|Model
     */
    public static function getAuthenticatedUser()
    {
        foreach(array_keys(config('auth.guards')) as $guard){
            if(auth()->guard($guard)->check()) {
                return auth()->guard($guard)->user();
            }
        }

        return null;
    }

    public static function resizeImageWithAspectRatio(Image $image, $width, $height)
    {
        $image->height() > $image->width() ? $width = null : $height = null;
        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        return $image;
    }

    public static function resizeImage(Image $image, $width, $height)
    {
        $image->resize($width, $height);

        return $image;
    }

    public static function paginateOrAll($query, $perPage = null)
    {
        $perPage = $perPage ?? \request('per_page', 10);

        return request('all', false) ? $query->get() : $query->paginate($perPage);
    }

    public static function paginateFromRequest($query, $perPage = 10)
    {
        return $query->paginate(request('per_page', $perPage));
    }

    public static function applyFilters($query)
    {
        static::searchFilters($query);
        static::dateFilter($query);
        static::sortBy($query);
    }
    public static function searchFilters($query, $paramsCount = 8, $prefix = '')
    {
        $prefix = empty($prefix) ? '' : $prefix . '.';
        for ($i = 1; $i <= $paramsCount; $i++) {
            $search = \request('search' . $i, false);
            $searchBy = \request('searchBy' . $i, false);
            if ($searchBy == 'category_id' && !empty($search)) {
                $query->whereHas('categoryPivot', function ($query2) use ($search) {
                    $query2->where('category_id', '=', $search);
                });

                return;
            }
            if(mb_strlen($search) > 0 && strlen($searchBy) > 0) {
                if(str_contains($searchBy, '_id')) {
                    $query->where($prefix . $searchBy, '=', $search);
                } else {
                    $query->where($prefix . $searchBy, 'LIKE', '%' . $search . '%');
                }
            }
        }
    }

    public static function dateFilter($builder)
    {
        $request = request();
        if($request->filled('start_date')) {
            $builder->where('created_at', '>', Carbon::createFromTimestamp($request->start_date));
        }
        if($request->filled('end_date')) {
            $builder->where('created_at', '<', Carbon::createFromTimestamp($request->end_date));
        }
    }

    public static function sortBy($builder)
    {
        if (request('sort', false)) {
            $order = 'asc';
            if(request('order', false) == 'desc')
            {
                $order = 'desc';
            }
            if (class_basename($builder) == 'Builder') {
                $builder->getQuery()->orders = null;
            } else {
                // is relationship
                $builder->getBaseQuery()->orders = null;
            }

            return $builder->orderBy(request('sort'), $order);
        }
    }

    public static function getIds($collection)
    {
        $ids = [];
        foreach ($collection as $item) {
            $ids[] = $item->id;
        }

        return $ids;
    }

    public static function getWhereInString(array $ids)
    {
        $queryString = ' ';
        foreach ($ids as $id) {
            $queryString .= $id . ',';
        }
        $queryString[strlen($queryString) - 1] = ' ';

        return $queryString;
    }

    public static function removeFromRequest(Request $request, ...$keys)
    {
        foreach ($keys as $key) {
            $jsonRequest = $request->json();
            $jsonRequest->remove($key);
            $request->request->remove($key);
        }
    }

    public static function makeValidationException($message, $key = 'unknown'): HttpResponseException
    {
        return new HttpResponseException(response()->error($message,
            [
                $key => [$message]
            ]
        , 422));
    }

    public static function makeWebValidationException($message, $key = 'unknown', $errorBag = 'default'): ValidationException
    {
        return ValidationException::withMessages([
            $key => [$message]
        ])
            ->errorBag($errorBag);
    }

    public static function getRealUrl()
    {
        return str_replace('api.', '', config('app.url'));
    }

    public static function getModelIdOnPut($model)
    {
        $model = request()->route($model);

        return is_object($model) ? $model->getKey() : $model;
    }

    // Return an object with only id and url
    public static function mediaToImage(?Media $media)
    {
        if (!$media) {
            return null;
        }
        $image = [];
        $image['id'] = $media->id;
        if (in_array($media->getExtensionAttribute(), ['docx', 'doc', 'ppt', 'txt', 'pptx', 'ppt'])) {
            $image['type'] = 'document';
        } else if (in_array($media->getExtensionAttribute(), ['zip', 'rar'])) {
            $image['type'] = 'archive';
        } else {
            $image['type'] = $media->type;
        }
        $image['url'] = $media->getUrl();

        return $image;
    }

    public static function mediasToImages(MediaCollection $mediaCollection)
    {
        $images = [];
        foreach ($mediaCollection as $media) {
            $images[] = Helpers::mediaToImage($media);
        }

        return $images;
    }

    /**
     * @param array $fields
     * @param $request
     * @return mixed
     */
    public static function toCarbonRequest(array $fields , $request): mixed
    {
        foreach ($fields as $field){
            if(is_numeric($request->input($field))){
                $request->merge([$field => Carbon::createFromTimestamp($request->input($field))->toDateTimeString()]);
            }else{
                $request->merge([$field => $request->input($field)]);
            }
        }
        return $request;
    }

    public static function hideAttributes(\Traversable $models, ...$attributes)
    {
        foreach ($models as $model) {
            $model->makeHidden($attributes);
        }
    }

    public static function randomString()
    {
        return bcrypt(md5(md5(time().time())));
    }

    public static function unsetFillable($model, ...$keys)
    {
        $fillable = $model->fillable;
        foreach ($keys as $key) {
            unset($fillable[$key]);
        }
        $model->fillable($fillable);
    }

    public static function searchOnRelations($model , $field , string $q , $searchIn)
    {
        $query = $model->whereHas($searchIn, function ($query) use ($q , $field) {

            $query->where($field , 'like', "%$q%");

        });

        return $query;
    }

    /**
     * Get random numbers code.
     *
     * @param int $digits
     * @return int
     */
    public static function randomNumbersCode(int $digits = 4)
    {
        return rand(pow(10, $digits-1), pow(10, $digits) - 1);
    }

    public static function isStringBase64(string $value, string $mime = 'gif|png|jpg|jpeg|svg|webp'): bool
    {
        $base64RegEx = '#^data:image\/(?:'.$mime.')(?:;charset=utf-8)?;base64,.*+={0,2}#';
        if (!preg_match($base64RegEx, $value)){
            return false;
        }

        return true;
    }

    public static function decodeUnicode($str)
    {
        return preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
            return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
        }, $str);
    }

    #[NoReturn] public static function checkResponseInTest($response)
    {
        dd(json_decode(Helpers::decodeUnicode($response->getContent())));
    }

    public static function hasCustomSearchBy($key)
    {
        for ($i = 1; $i < 99; $i++) {
            if (\request('searchBy' . $i) === $key && \request('search' . $i)) {
                $temp = \request('search' . $i);
                request()->merge(['search' . $i => null]);

                return $temp;
            }
        }

        return null;
    }

    public static function cacheRemember($key, $ttl, $callback)
    {
        return app()->environment('production') ? \Cache::remember($key, $ttl, $callback) : $callback();
    }

    public static function cacheForever($key, $callback)
    {
        return app()->environment('production') ? \Cache::rememberForever($key, $callback) : $callback();
    }

    public static function clearCacheInBooted($model, $key)
    {
        $key = is_array($key) ? $key : [$key];
        $model::updated(function () use ($key){
            \Cache::deleteMultiple($key);
        });
        $model::deleted(function () use ($key){
            \Cache::deleteMultiple($key);
        });
        $model::created(function () use ($key){
            \Cache::deleteMultiple($key);
        });
    }

    public static function convertFaNumbersToEn($string) {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }

    public static function setEventNameForLog($eventName): string
    {
        if ($eventName == 'updated'){
            return 'بروزرسانی';
        }
        if ($eventName == 'deleted'){
            return  'حذف';
        }
        if ($eventName == 'created'){
            return 'ایجاد';
        }
        return $eventName;
    }

    public static function getDeviceTokens($model , array $ids): array
    {
        $model = ucfirst($model);
        $tokens = DB::table('personal_access_tokens')
            ->where('tokenable_type', "Modules\{$model}\Entities\{$model}")
            ->whereNotNull('device_token')
            ->whereIn('tokenable_id', $ids)
            ->get('device_token')
            ->pluck('device_token')->toArray();

        return array_values(array_unique($tokens));
    }

    public static function removeComma(string $value) : string
    {
        return str_replace(',', '', $value);
    }

    public static function assignLocaleKeysToModel($model, $request)
    {
        // dd($request->input('languages'));
        $languages = $request->input('languages') ?? [];

        static::assignLocaleKeysToModelByArray($model, $languages);
    }

    /**
     * @param $model
     * @param array $languages
     */
    public static function assignLocaleKeysToModelByArray($model, array $languages)
    {
        // dd($languages);
        foreach ($languages as $locale => $values) {
            if (Language::languageExists($locale)) {
                foreach ($model->getTranslatableAttributes() as $translatable) {
                    if (isset($values[$translatable])) {
                        $value = $values[$translatable];
                        $model->setTranslation($translatable, $locale, $value);
                    } else {
                        $model->setTranslation($translatable, $locale, '');
                    }
                }
            }
        }
    }

    public static function sortOrders(Model $model, int $order): void
    {
        $id = $model->id;
        $oldOrder = $model->order;
        $orders = [];
        $orderedServices = $model->query()->ordered()->where('id', '!=', $id)->get(['id', 'order']);

        if ($order < $oldOrder) {
            $beforeOrders = $orderedServices->where('order', '<', $order)->pluck('id')->all();
            $orders = $beforeOrders;
            $orders[] = $id;
            $afterOrders = $orderedServices->where('order', '>=', $order)->pluck('id')->all();
            $orders = array_merge($orders, $afterOrders);

        } elseif ($order > $oldOrder) {
            $beforeOrders = $orderedServices->where('order', '<=', $order)->pluck('id')->all();
            $orders = $beforeOrders;
            $orders[] = $id;
            $afterOrders = $orderedServices->where('order', '>', $order)->pluck('id')->all();
            $orders = array_merge($orders, $afterOrders);
        }

        if (count($orders) > 0) {
            $model->setNewOrder($orders);
        }
    }

    public static function toGregorian(string $jDate): ?string
    {
        $output = null;
        $pattern = '#^(\\d{4})/(0?[1-9]|1[012])/(0?[1-9]|[12][0-9]|3[01])$#';

        if (preg_match($pattern, $jDate)) {
            $jDateArray = explode('/', $jDate);
            $dateArray = Verta::getGregorian(
                $jDateArray[0],
                $jDateArray[1],
                $jDateArray[2]
            );
            $output = implode('/', $dateArray);
        }

        return $output;
    }

    public static function limitText($string,$length): string
    {
        $string = strip_tags($string);
        if (strlen($string)) {
            // truncate string
            $stringCut = substr($string, 0, $length);
            $endPoint = strrpos($stringCut, ' ');

            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $string .= '...';
        }
        return $string;
    }

    public static function checkAcceptLanguage($l)
    {
        $languages = Language::query()->get()->pluck('name')->toArray();
        if (!in_array($l, $languages)){
            $l = 'fa';
        }

        return $l;
    }
    public static function to_english_numbers(String $string): String {
        $persinaDigits1 = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $persinaDigits2 = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
        $allPersianDigits = array_merge($persinaDigits1, $persinaDigits2);
        $replaces = [...range(0, 9), ...range(0, 9)];

        return str_replace($allPersianDigits, $replaces , $string);
    }
}
