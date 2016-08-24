<template>
    <div class="widget widget-default">
        <div class="widget-header">分类</div>
        <ul class="list-group">
            <li class="list-group-item">
                {{ category }}
            </li>
        </ul>
    </div>
</template>

<script>
    /*import HeaderComponent from './components/header.vue'
     import OtherComponent from './components/other.vue'*/
    export default{
        data(){
            return {
                category: 'hello world'
            }
        },

    }
</script>
