<template>
    <div class="widget widget-default">
        <div class="widget-body">
            {{ content }}
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                content: ''
            }
        },
        ready(){
            this.$http.get('/api/post/ad-voluptates-non-rerum-aspernatur-enim')
                    .then(response => {
                        console.log(response.data)
                        this.content = marked(response.data.content);
                    });
        }
    }
</script>
