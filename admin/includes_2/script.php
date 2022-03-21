    <?php include __DIR__ . '/../../includes/modal.php';?>
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://momentjs.com/downloads/moment-timezone-with-data.min.js"></script>
    <script src="../plugins/jquery-confirm-3.3.2/js/jquery-confirm.min.js"></script>
    <script src="../plugins/iziToast-master/dist/js/iziToast.min.js"></script>
    <script src="../plugins/jquery-validate-1.19.1/jquery.validate.min.js"></script>
    <script src="../assets/js/function_izitoast.js"></script>
    <script src="../assets/js/admin/info_cnt.js"></script>
    <?php
        if (isset($scriptjs) || is_array(@$scriptjs)) {
            foreach ($scriptjs as $js) {
                echo "<script src='$js'></script>";
            }
        }
    ?>
    <script>
        jQuery(function ($) {
            $("ul a").click(function(e) {
                var link = $(this);
                var item = link.parent("li");
                
                if (item.hasClass("active")) {
                    item.removeClass("active").children("a").removeClass("active");
                } else {
                    item.addClass("active").children("a").addClass("active");
                }

                if (item.children("ul").length > 0) {
                    var href = link.attr("href");
                    link.attr("href", "#");
                    setTimeout(function () { 
                        link.attr("href", href);
                    }, 300);
                    e.preventDefault();
                }
            }).each(function() {
                var link = $(this);
                if (link.get(0).href === location.href) {
                    link.addClass("active").parents("li").addClass("active");
                    return false;
                }
            });
        });
    </script>