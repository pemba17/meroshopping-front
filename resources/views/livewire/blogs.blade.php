<div>
    <div class="breadcrumbs">
        <div class="container">
            <div class="title-breadcrumb">
                Blogs
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div id="content" class="col-sm-12">
                <div class="blog-header">
                    <h3>Simple Blog</h3>
                </div>
                <div class="blog-listitem row">
                    @foreach($blogs as $row)
                        <div class="blog-item col-md-6 col-sm-6">
                            <div class="blog-item-inner">
                                <div class="itemBlogImg left-block">
                                    <div class="article-image banners">
                                        <div>
                                            <a class="popup-gallery" href="image/catalog/demo/blog/5.jpg">
                                            <img src="image/catalog/demo/blog/5.jpg" alt="{{$row->blog_title}}">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="itemBlogContent right-block ">
                                    <div class="blog-content">
                                        <div class="article-date">
                                            <div class="date">
                                                <span class="article-date">
                                                    <b>17</b> Oct
                                                </span>
                                            </div>
                                        </div>
                                        <div class="article-title font-title">
                                            <h4><a href="aafas">{{$row->blog_title}}</a></h4>
                                        </div>
                                        <p class="article-description">
                                            {!!substr($row->blog_description,0,500)!!}
                                        </p>
                                        <div class="blog-meta">
                                            <span class="author"><span>Post by </span>Tuandt</span> / &nbsp;
                                            <span class="comment_count"><a href="#">0 Comments</a></span>
                                        </div>
                                        <div class="readmore hidden">
                                            <a class="btn-readmore font-title" href="#">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div style="float: right">{{$blogs->links('pagination-links')}}</div>   
                </div>
            </div>
        </div>
    </div>
</div>
