            <div class="row">
                <div class="col-lg-12">
                    <div class="wizard">
                        <a><span class="badge"></span> Posts</a>
                        <a href="<?php echo WY_Registry::get('router')->generate('admin-posts');?>"><span class="badge"></span> All Posts</a>
                        <a class="current"><span class="badge badge-inverse"></span> Edit Posts</a>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading ">
                            <?php echo $post->title;?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- CKEDITOR and FORM HERE -->
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" method="POST" action="" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Post Title</label>
                                            <input type="text" id="title" name="title" value="<?php echo $post->title;?>" placeholder="Post Title" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Permalink</label>
                                            <input type="text" id="permalink" name="permalink" value="<?php echo $post->permalink;?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Post Category</label>
                                            <select class="form-control" id="category" name="category">
                                                <?php if(!empty($cat)): ?>
                                                <option></option>
                                                    <?php foreach($cat as $c):
                                                    if($c->cat_id===$post->cat_id)
                                                    {
                                                        ?>
                                                <option value="<?php echo $c->cat_id;?>" selected="selected"><?php echo $c->title;?></option>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                <option value="<?php echo $c->cat_id;?>"><?php echo $c->title;?></option>
                                                        <?php
                                                    }
                                                    endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Post Content</label>
                                            <textarea id="content" name="content" class="form-control" rows="3"><?php echo $post->content;?></textarea>
                                            <script type='text/javascript' src='<?php echo WY_Request::base_url(); ?>/assets/admin/ckeditor/config.editor.js'></script>
                                        </div>
                                        <div class="form-group">
                                            <label>Allow Comment</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input name="a_comment" type="checkbox"  <?php if($post->comment_open===1) echo "checked"; ?>>Allow Comment on Page
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Published</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input name="published" type="checkbox" <?php if($post->published===1) echo "checked"; ?>>Publish Post
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tags List</label>
                                            <input type="text" id="tags" name="tags" value="<?php echo $post->tag;?>" placeholder="Tags List" class="form-control" data-role="tagsinput">
                                        </div>
                                        <button type="submit" class="btn btn-info">Save Post</button>
                                        <button type="reset" class="btn btn-warning">Reset Form</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.row -->