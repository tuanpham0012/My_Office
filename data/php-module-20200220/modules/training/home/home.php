<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <h1 class="display-5">Trung tâm đào tạo lập trình online edupham.com</h1>
        <p>Được thành lập từ năm 2020...</p>
        <p><a class="btn btn-primary btn-lg" href="javascript:void(0)" role="button">Xem thêm &raquo;</a></p>
    </div>
</div>

<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-lg-12 text-center mb-1">
            <div class="spinner-border" id="data-loading" style="display: none"></div>
        </div>
    </div>
    <div class="row" id="ajax_list"></div>
    <div class="row">
        <div class="col-lg-12 text-center mb-1">
            <div class="spinner-border" id="data-loading-more" style="display: none"></div>
        </div>
        <div class="col-lg-12 text-center mt-3 mb-3">
            <input type="hidden" name="ajax_load_more" id="ajax_load_more" value="3">
            <button class="btn btn-info" id="btn-load-more" onclick="loadMore()">Xem thêm</button>
        </div>
    </div>
    <hr>

</div> <!-- /container -->
<script>
    $(document).ready(function () {
        $('#data-loading').show();
        loadData(1, 8);

    });

    function loadMore() {
        var page = $('#ajax_load_more').val();
        loadData(page, 4, true);
    }

    function loadData(page_index, page_size, is_loadmore=false) {
        if (is_loadmore) {
            $('#data-loading-more').show();
        } else {
            $('#data-loading').show();
        }

        var url_ajax = 'http://edupham.com/api/v1/education/get-course-list';
        var data = {
            page_index: page_index,
            page_size: page_size
        }

        $.ajax({
            url: url_ajax,
            type: 'GET',
            dataType: 'JSON',
            data: data,
            success: function(result) {
                $('#data-loading').hide();
                $('#data-loading-more').hide();
                var course_list = '';
                if (result.code == 200) {
                    result.data.forEach(function (course) {
                        course_list += '<div class="col-lg-3 mt-3">' +
                            '<div class="card" style="height: 450px; position: relative">' +
                            '<img class="card-img-top" src="'+ course.icon +'" alt="'+ course.name +'">' +
                            '<div class="card-body">' +
                            '<span class="badge badge-secondary product-method">Online</span>' +
                            '<h5 class="card-title">'+ course.name +'</h5>' +
                            '<span class="product-summary">Khóa học online : '+ course.code +'</span>' +
                            '<p class="card-text product-price">'+ $.number(course.price, 0, ",", ".") +' ₫</p>' +
                            '<a href="javascript:void(0)" class="btn btn-danger product-btn-buy">Đăng ký học</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    });
                }
                if (is_loadmore) {
                    $('#ajax_load_more').val(parseInt(page_index)+1);
                    $('#ajax_list').append(course_list);
                } else {
                    $('#ajax_list').html(course_list);
                }
            },
            error: function (jqXhr, textStatus, errorMessage) {}
        });
    }
</script>