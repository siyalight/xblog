<template>
    <div class="widget widget-default">
        <div class="widget-header">分类</div>
        <ul class="list-group">
            <a @click="click(category)" class="list-group-item"
               v-for="category in categories">
                {{ category.name }}
                <span class='badge'>
                    {{ category.posts_count }}
                </span>
            </a>
        </ul>
    </div>
</template>

<script>
    /*import HeaderComponent from './components/header.vue'
     import OtherComponent from './components/other.vue'*/
    export default{
        data(){
            return {
                categories: [],
                currentCategory: '',
            }
        },
        ready(){
            this.$http.get('/api/categories')
                    .then(response => {
                        this.categories = response.data;
                    });
        },
        computed: {
            currentClass(category) {
                return category.name == this.currentCategory ? 'list-group-item active' : 'list-group-item';
            },
        },
        methods: {
            click(category){
                this.currentCategory = category.name;
                console.log(category.name)
            },
            currentClass(category) {
                return category.name == this.currentCategory ? 'list-group-item active' : 'list-group-item';
            },

        }

    }
</script>
