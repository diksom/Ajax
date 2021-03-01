<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Vue</title>
</head>

<body>
    <div id="app">
        <form>
            <h3>User</h3>
            <input type="text" v-model="form.name">
            <button type="button" @click.prevent="add" v-show="!updateSubmit">Add</button>
            <button type="button" @click.prevent="update(users)" v-show="updateSubmit">Update</button>
        </form>
        <ul v-for="(user, index) in users">
            <li>
                <span>@{{user.name}}</span>
                <button type="button" @click="edit(user)">Edit</button> || <button type="button" @click="del(user,index)">Delete</button>
            </li>
        </ul>
    </div>
    <script src="{{url('/belajar-vue/vue-script.js')}}"></script>
    <script src="{{url('/belajar-vue/vue-resource.js')}}"></script>
    <script src="{{url('/belajar-vue/index.js')}}"></script>
</body>

</html>