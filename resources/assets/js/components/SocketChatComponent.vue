<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <textarea rows="6" readonly="" class="form-control" >{{dataMessages.join('\n')}}</textarea>
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" placeholder="Введите сообщение" v-model="message">
                    <div class="input-group-append">
                        <button @click="sendMessage" class="btn btn-outline-secondary" type="button">Отправить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                dataMessages: [],
                message: '',
            }
        },
        mounted() {
            var socket = io('http://localhost:3000');

            socket.on('news-action:App\\Events\\NewMessage', function(data){
                this.dataMessages.push(data.message);
            }.bind(this));
        },
        methods:{
            sendMessage: function(){
                axios({
                    method: "GET",
                    url: '/start/send-message',
                    params: {
                        message: this.message
                    }
                })
                .then((response) => {
                    this.message = '';
                })
            }
        }
    }
</script>
