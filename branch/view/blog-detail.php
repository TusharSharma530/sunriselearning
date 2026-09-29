<?php if(!empty($rwblogdetail)){ ?>
<div class="pagewidget">
<div class="container-lg">
    <div class="row">
        <div class="col-md-12">
            <div class="blog-desc" style="font-size:15px;line-height:1.8;color:#333;">
                <?=$rwblogdetail['desc'];?>
            </div>
            <style>
                .blog-desc p { margin: 0 0 15px; display: block; }
                .blog-desc h1, .blog-desc h2, .blog-desc h3, .blog-desc h4, .blog-desc h5, .blog-desc h6 { margin: 25px 0 12px; font-weight: 700; display: block; }
                .blog-desc h1 { font-size: 28px; }
                .blog-desc h2 { font-size: 24px; }
                .blog-desc h3 { font-size: 20px; }
                .blog-desc h4 { font-size: 18px; }
                .blog-desc ul, .blog-desc ol { padding: 0 0 15px 25px; margin: 0 0 15px; list-style-type: disc; display: block; }
                .blog-desc ol { list-style-type: decimal; }
                .blog-desc li { margin: 0 0 5px; display: list-item; }
                .blog-desc a { color: #1a73e8; text-decoration: underline; display: inline; }
                .blog-desc a:hover { color: #0d47a1; }
                .blog-desc img { max-width: 100%; height: auto; border-radius: 8px; margin: 10px 0; }
                .blog-desc table { width: 100%; border-collapse: collapse; margin: 15px 0; }
                .blog-desc table th, .blog-desc table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
                .blog-desc table th { background: #f5f5f5; font-weight: 600; }
                .blog-desc blockquote { border-left: 4px solid #1a3a5c; padding: 10px 20px; margin: 15px 0; background: #f9f9f9; font-style: italic; }
                .blog-desc strong, .blog-desc b { font-weight: 700; }
                .blog-desc em, .blog-desc i { font-style: italic; }
            </style>
        </div>
    </div>
    <div class="row" style="margin-top:40px;">
        <div class="col-md-12">
            <div style="background:#f5f0fa;padding:30px;border-radius:10px;">
                <h3 style="font-size:24px;font-weight:700;color:#333;margin:0 0 10px;">Leave a Reply</h3>
                <p style="font-size:14px;color:#666;margin:0 0 20px;">Your email address will not be published. Required fields are marked *</p>
                <form method="POST">
                    <div style="margin-bottom:20px;">
                        <label style="display:block;font-size:14px;font-weight:600;color:#333;margin-bottom:5px;">COMMENT *</label>
                        <textarea name="comment" rows="6" required style="width:100%;padding:10px;border:1px solid #ddd;border-radius:5px;font-size:14px;"></textarea>
                    </div>
                    <div style="margin-bottom:20px;">
                        <label style="display:block;font-size:14px;font-weight:600;color:#333;margin-bottom:5px;">NAME *</label>
                        <input type="text" name="name" required style="width:100%;padding:10px;border:1px solid #ddd;border-radius:5px;font-size:14px;">
                    </div>
                    <div style="margin-bottom:20px;">
                        <label style="display:block;font-size:14px;font-weight:600;color:#333;margin-bottom:5px;">EMAIL *</label>
                        <input type="email" name="email" required style="width:100%;padding:10px;border:1px solid #ddd;border-radius:5px;font-size:14px;">
                    </div>
                    <div style="margin-bottom:20px;">
                        <label style="display:block;font-size:14px;font-weight:600;color:#333;margin-bottom:5px;">WEBSITE</label>
                        <input type="url" name="website" placeholder="https://" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:5px;font-size:14px;">
                    </div>
                    <div style="margin-bottom:20px;">
                        <label style="font-size:14px;color:#333;cursor:pointer;">
                            <input type="checkbox" name="save_info" style="margin-right:8px;">
                            Save my name, email, and website in this browser for the next time I comment.
                        </label>
                    </div>
                    <button type="submit" name="post_comment" style="padding:12px 30px;background:var(--primary-color);color:#fff;border:none;border-radius:5px;font-size:16px;font-weight:600;cursor:pointer;">Post Comment</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php } ?>
