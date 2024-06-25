<script>
    var $fromDate = new Date({{request('from_date')}});
    var $toDate = new Date({{request('from_date')}});
    $('#from_date_show').MdPersianDateTimePicker({
        targetDateSelector: '#from_date',
        targetTextSelector: '#from_date_show',
        englishNumber: false,
        fromDate:true,
        enableTimePicker: false,
        dateFormat: 'yyyy-MM-dd',
        textFormat: 'yyyy-MM-dd',
        groupId: 'rangeSelector1',
    });
    $('#to_date_show').MdPersianDateTimePicker({
        targetDateSelector: '#to_date',
        targetTextSelector: '#to_date_show',
        englishNumber: false,
        toDate:true,
        enableTimePicker: false,
        dateFormat: 'yyyy-MM-dd',
        textFormat: 'yyyy-MM-dd',
        groupId: 'rangeSelector1',
    });
</script>

