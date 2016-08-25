<template>
    <ul class="pagination">
        <li class="disabled" v-if="current_page <= 1"><span>&laquo;</span></li>
        <li @click="prev" v-else><a rel="prev" href="#">&laquo;</a></li>

        <li class="disabled" v-if="current_page >= total"><span>&raquo;</span></li>
        <li @click="next" v-else><a rel="next" href="#">&raquo;</a></li>
    </ul>
</template>
<script>
    export default{
        props: ['current_page', 'total'],
        data(){
            return {
                msg: 'hello vue'
            }
        },
        methods: {
            prev(){
                this.current_page--;
                this.$parent.$dispatch('onPageChange', this.current_page);
            },
            next(){
                this.current_page++;
                this.$parent.$dispatch('onPageChange', this.current_page);
            }
        }

    }
</script>
