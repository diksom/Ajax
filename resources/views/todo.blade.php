<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan</title>
    <style media="screen">
        .completed {
            text-decoration: line-through;
        }
    </style>
</head>

<body>
    <div id="app">
        <h3> Todo List</h3>
        <input type="text" v-model="newTodo" @keyup.enter="addTodo">
        <ul>
            <li v-for="(todo, index) in todos">
                <span v-bind:class="{'completed' : todo.done}">@{{todo.text}}</span>
                <button type="button" v-on:click="removeTodo(index,todo)">X</button>
                <button type="button" v-on:click="toggleComplete(todo)">Done</button>
            </li>
        </ul>
    </div>
    <script src="{{url('/belajar-vue/vue-script.js')}}"></script>
    <script src="{{url('/belajar-vue/vue-resource.js')}}"></script>
    <script>
        new Vue({
            el: "#app",
            data: {
                newTodo: "",
                todos: []
            },
            methods: {
                addTodo: function() {
                    let textInput = this.newTodo.trim();
                    if (textInput) {
                        this.$http.post('/api/todo', {
                            text: textInput
                        }).then(response => {
                            this.todos.unshift({
                                text: textInput,
                                done: 0
                            })
                            this.newTodo = ''
                        });

                    }
                },
                removeTodo: function(index, todo) {

                    this.$http.post('/api/todo/delete/' + todo.id).then(response => {
                        this.todos.splice(index, 1)
                    });

                },
                toggleComplete: function(todo) {
                    this.$http.post('/api/todo/change-done-status/' + todo.id).then(response => {
                        todo.done = !todo.done
                    });
                }
            },
            mounted: function() {
                this.$http.get('/api/todo').then(response => {
                    let result = response.body.data;
                    this.todos = result;

                });
            }
        });
    </script>
</body>

</html>