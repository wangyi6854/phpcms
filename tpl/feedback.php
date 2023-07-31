<?php
include ROOT . '/tpl/header.php';
include ROOT . '/tpl/my.nav.php';

?>

<section class="paddingTop-20 ">
    <div class="container">
        <div class="row ">
            <div class="col-lg-12 text-center py-3">
                <h3 class="text-white"><i class="ti-comments pr-2"></i><strong>意见反馈</strong></h3>
            </div>
        </div>

        <div class="card shadow-v2">
            <div class="card-body p-3">

                <div class="d-md-flex justify-content-between my-4">
                    <div class="form-group">
                        <label>反馈标题：</label>
                        <input type="text" class="form-control" id="title" required/>
                    </div>
                </div>
                <div class="d-md-flex justify-content-between my-4">
                    <div class="form-group">
                        <label>反馈内容：</label>
                        <textarea type="text" class="form-control" rows="3" id="content" required></textarea>
                    </div>
                </div>
                <div class="d-md-flex justify-content-between my-4">
                    <button class="btn btn-block btn-danger" id="b">提交</button>
                </div>
                </form>
            </div>
        </div>

        <!-- END row-->
    </div>
    <!-- END container-->
</section>


<script src="assets/js/vendors.bundle.js"></script>
<script src="assets/js/app.min.js"></script>
<script src="js/site.js"></script>
<script>
    $(function() {
        $('#b').click(function (){

            var title = $('#title').val();
            if ( !title.length ) {
                show_message('请填写标题');
                return false;
            }

            var content = $('#content').val();
            if ( !content.length ) {
                show_message('请填写反馈内容');
                return false;
            }

            $.post('./', {
                module: 'feedback',
                title:  title,
                content:  content
            }, function (data){
                if ( data.data.success ) {
                    show_message( data.data.message, './?module=my.venue&venue=<?php echo rawurlencode($venue); ?>');
                }
                else {
                    show_message(data.data.message);
                }
                return false;
            });

            return false;
        });
    });
</script>

<?php
include ROOT . '/tpl/footer.php';
?>
