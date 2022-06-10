<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 16/02/2020
 * Time: 11:47 AM
 */

$postFields = ['city_id' => 1905099];
$url = EDUPHAM_WEATHER . '?city_id=1905099';
$method = 'GET';

$dt = callCurl($postFields, $url, $method);
////echo '<pre>';
//print_r($dt);
//echo '<pre>';

$provinces = callCurl([], EDUPHAM_PROVINCE, 'GET');
$provinces = json_decode($provinces);
echo '<pre>';
//print_r($provinces->data);
echo '</pre>';

?>
<div class="col-lg-12 mt-2"><h3>Xem thời tiết hiện tại của Tỉnh/TP</h3></div>
<div class="col-lg-12 text-center mb-1" style="position: absolute; top: 10px;">
    <div class="spinner-border" id="data-loading" style="display: none"></div>
</div>
<div class="col-lg-3 mt-2">
    <select name="province_id" id="province_id" class="form-control">
        <option value="-1">- Chọn Tỉnh/TP -</option>
        <?php if ($provinces->code == 200) : foreach ($provinces->data as $key => $province) : $item = (array)$province  ?>
            <option value="<?php echo $item['openweather_id'] ?>"><?php echo $item['name'] ?></option>
        <?php endforeach; ?>
        <?php endif; ?>
    </select>
</div>
<div class="col-lg-6 mt-2">
    <div id="ajax_list"></div>
</div>
<script>
    $(document).ready(function () {
        $('#province_id').select2();
        filterBySelectBox('province_id', '<?php echo EDUPHAM_WEATHER ?>');
    });

    function filterBySelectBox(id, url_ajax){
        $('#'+id).change(function(){
            getDataByAjax(url_ajax, 1);
        });
    }

    function getDataByAjax(url_ajax, page_index) {
        $('#data-loading').show();

        var province_id = $('#province_id').val();
        var province_name = $( "#province_id option:selected" ).text();
        var data = {
            city_id: province_id
        };
        $.ajax({
            url: url_ajax,
            type: 'GET',
            dataType: 'JSON',
            data: data,
            success: function(result) {
                $('#data-loading').hide();
                var res = '';
                if (result.code == 200) {
                    res += '<table class="table table-striped">' +
                        '<thead>' +
                        '<tr>' +
                        '<th class="text-center">Nội dung</th><th class="text-center">Thông tin</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>' +
                        '<tr><td>Tỉnh/TP</td><td>'+ province_name +'</td></tr>' +
                        '<tr><td>Hình ảnh minh họa</td><td><img src="'+ result.data.icon +'"></td></tr>' +
                        '<tr><td>Tình trạng</td><td>'+ result.data.description +'</td></tr>' +
                        '<tr><td>Nhiệt độ trung bình</td><td>'+ result.data.temp +' &#8451;</td></tr>' +
                        '<tr><td>Nhiệt độ thấp nhất</td><td>'+ result.data.temp_min +' &#8451;</td></tr>' +
                        '<tr><td>Nhiệt độ cao nhất</td><td>'+ result.data.temp_max +' &#8451;</td></tr>' +
                        '</tbody>' +
                        '</table>';
                } else {
                    res = result.message;
                }
                $('#ajax_list').html(res);
            },
            error: function (jqXhr, textStatus, errorMessage) {}
        });
    }

</script>