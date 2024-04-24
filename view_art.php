<?php include 'admin/db_connect.php' ?>

<?php
// Check if 'id' parameter is set in the URL
if(isset($_GET['id'])){
    // Retrieve art details from the database based on the provided ID
    $qry = $conn->query("SELECT a.*,u.name as aname FROM arts a inner join users u on u.id = a.artist_id where a.id= ".$_GET['id']);
    // Loop through the fetched array and assign values to variables
    foreach($qry->fetch_array() as $k => $val){
        $$k=$val;
    }

    // Check if there are any files associated with the art
    $fs = $conn->query("SELECT * FROM arts_fs where art_id = $id ");
    if($fs->num_rows > 0):
        $fs_aid = $fs->fetch_array();
    endif;
}
?>

<style type="text/css">
    /* CSS styles for image display */
    .imgs{
        margin: .5em;
        max-width: calc(100%);
        max-height: calc(100%);
    }
    .imgs img{
        max-width: calc(100%);
        max-height: calc(100%);
        cursor: pointer;
    }
    #content{
        border-left:1px solid gray;
    }
    header.masthead {
        min-height: 20vh !important;
        height: 20vh !important;
    }
</style>

<!-- Header section -->
<header class="masthead">

</header>

<!-- Main content section -->
<section>
    <div class="container-field">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Display images related to the art -->
                        <div class="col-md-4">
                            <div class="row">
                                <?php 
                                $images = array();
                                if(isset($id)){
                                    $fpath = 'admin/assets/uploads/artist_'.$id;
                                    $images= scandir($fpath);
                                }
                                foreach($images as $k => $v):
                                    if(!in_array($v,array('.','..'))):
                                ?>
                                <div class="imgs">
                                    <img src="<?php echo $fpath.'/'.$v ?>" alt="">
                                </div>
                                <?php
                                    else:
                                        unset($images[$v]);
                                    endif;
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <!-- Display art details -->
                        <div class="col-md-8" id="content">
                            <h4 class="text-center"><b><?php echo ucwords($art_title) ?></b></h4>
                            <hr class="divider">
                            <center><small><?php echo ucwords($aname) ?></small></center>
                            <center>
                                 <!-- Display art status and price if available for sale -->
                                <?php if(isset($fs_aid)): ?>
                                    <div>
                                        <span class="badge badge-success">For Sale</span>
                                        <span class="badge badge-secondary"><i class="fa fa-tag"></i> <?php echo number_format($fs_aid['price'],2) ?></span>
                                        <span  class="badge badge-primary"><a href="javascript:void(0)" class="order_this text-white" data-id="<?php echo $fs_aid['id'] ?>">Buy</a></span>
                                    </div>
                                <?php endif; ?>
                            </center>
                            <br>
                            <!-- Display art description -->
                            <?php echo html_entity_decode($art_description); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript script -->
<script>
    // Handle click on art images to view larger version
    $('.imgs img').click(function(){
        viewer_modal($(this).attr('src'))
    })
    // Handle click on order button to manage order for the art
    $('.order_this').click(function(){
        uni_modal("Request Order","manage_order.php?fs_id="+$(this).attr('data-id'))
    })
</script>
