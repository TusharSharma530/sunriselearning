<div class="pagewidget">
<div class="container-lg">
    <div class="text-center mb-4">
        <!-- <h2 style="font-size:32px;font-weight:700;color:#333;">Gallery</h2> -->
    </div>
    <?php
  
    $gallerycatid = 0;
    $sqlgallerycat = mysqli_query($con, "SELECT `id` FROM `category` WHERE `c_url` = 'gallery' LIMIT 1");
    if(mysqli_num_rows($sqlgallerycat)){
        $rwgallerycat = mysqli_fetch_assoc($sqlgallerycat);
        $gallerycatid = intval($rwgallerycat['id']);
    }
    $sqlgallery = $gallerycatid ? mysqli_query($con, "SELECT * FROM `media` WHERE `cat_id` = $gallerycatid ORDER BY `id` DESC") : false;
    if($sqlgallery && mysqli_num_rows($sqlgallery)){
    ?>
    <div class="row" id="lightgallery">
        <?php while($rwgallery = mysqli_fetch_assoc($sqlgallery)){ ?>
        <div class="col-md-3 col-sm-6 mb-4" data-src="<?=$path.$rwgallery['file'];?>">
            <div style="border:2px solid #333;border-radius:15px;overflow:hidden;height:250px;">
                <img src="<?=$path.$rwgallery['file'];?>" alt="Gallery" style="width:100%;height:250px;object-fit:cover;cursor:pointer;">
            </div>
        </div>
        <?php } ?>
    </div>
    <?php }else{ ?>
    <p class="text-center">No images found.</p>
    <?php } ?>
</div>
</div>
