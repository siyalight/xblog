<template>
    <article class="post" v-for="post in post_list">
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
</template>

<script>
    /*import HeaderComponent from './components/header.vue'
     import OtherComponent from './components/other.vue'*/
    export default{
        props: ['category', 'page'],
        data() {
            return {
                currentCategory: '',
                post_list: [],
            }
        },
        ready(){
            this.$http.get('/api/posts')
                    .then(response => {
                        this.post_list = response.data.data;
                    });
        },
    }
</script>
