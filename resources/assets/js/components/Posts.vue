<template>
    <article class="post" v-for="post in posts.data">
        <!-- post header -->
        <div class="post-header">
            <h1 class="post-title">
                <a href="{{ 'post/' + post.slug }}">{{ post.title }}</a>
            </h1>
            <div class="post-meta">
                           <span class="post-time">
                           <i class="fa fa-calendar-o"></i>
                           <time datetime="2016-08-05T00:10:14+08:00">
                           {{ post.published_at }}
                           </time>
                           </span>
                <span class="post-category">
                           &nbsp;|&nbsp;
                           <i class="fa fa-folder-o"></i>
                           <span>
                           <a href="{{ 'category/'+post.category.name }}">
                           <span>{{ post.category.name }}</span>
                           </a>
                           </span>
                           </span>
            </div>
        </div>
        <!-- post content -->
        <div class="post-content">
            <p>
                {{ post.description }}
            </p>
        </div>
        <!-- read more -->
        <div class="post-permalink">
            <a href="{{ 'post/' + post.slug }}" class="btn btn-more">阅读全文</a>
        </div>
        <!-- post footer -->
        <div class="post-footer clearfix">
            <div class="pull-left tag-list">
                <i class="fa fa-tags"></i>
                <template v-for="tag in post.tags">
                    <a href="#">{{tag.name }}</a>
                </template>
            </div>
        </div>
    </article>
    <pagination :current_page="1" :total="posts.last_page">

    </pagination>
</template>

<script>
    import Pagination from './Pagination.vue'
    export default{
        data() {
            return {
                currentCategory: '',
                currentPage: 1,
                posts: [],
            }
        },

        ready(){
            this.loadPosts('', 1);
        },
        events: {
            'onCategoryChange': function (category) {
                this.currentCategory = category;
                this.currentPage = 1;
                this.loadPosts(category.name, 1);
            },
            'onPageChange': function (page) {
                this.currentPage = page;
                console.log('currentPage' + page);
                if (this.currentCategory) {
                    this.loadPosts(this.currentCategory.name, page);
                }
                else {
                    this.loadPosts('', page);
                }
            }
        },
        methods: {
            loadPosts(categoryName, currentPage)
            {
                this.$http.get('/api/posts?category=' + categoryName + '&page=' + currentPage)
                        .then(response => {
                            this.posts = response.data;
                            console.log(response.data)
                        });
            }
        },
        components: {
            'pagination': Pagination,
        }
    }
</script>
