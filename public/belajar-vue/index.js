var app = new Vue({
    el:'#app',
    data(){
        return{
            users:[],
        updateSubmit:false,
        form:{
            'name':''
        },
        selectedUserId:null,
        }
    },methods:{
        add:function(){
            let textInput = this.form.name.trim();
            if (textInput) {
                this.$http.post('/api/index', {
                    name: textInput
                }).then(response => {
                    this.users.unshift({
                        name: textInput
                    })
                    this.form.name = ''
                });  
        }
    },
        edit(user){
            this.selectedUserId=user.id
            this.updateSubmit=true
            this.form.name=user.name
        },
        update(){
            let textInput = this.form.name.trim();
            if (textInput) {
                this.$http.post('/api/index/change-name/'+this.selectedUserId).then(response => {
                    this.users[this.selectedUserId].name=this.form.name
                    this.form={}
                    this.updateSubmit=false
                    this.selectedUserId=null
                    });
            }
        },
        del(user,index){
        var r =confirm("Anda Yakin ?")
        if(r){
            this.$http.post('/api/index/delete/' + user.id).then(response => {
                this.users.splice(index, 1)
                this.form={}
            });
        } 
        }
    },
    mounted: function() {
        this.$http.get('/api/index').then(response => {
            let result = response.body.data;
            this.users = result;

        });
    }
    });