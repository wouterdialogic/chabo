<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.5.0/css/bulma.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://intercoolerreleases-leaddynocom.netdna-ssl.com/intercooler-1.1.2.min.js"></script>
    <script src="https://unpkg.com/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Givin The Dog A Bone</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

</head>
<style type="text/css">
    /*pre {
        white-space: -moz-pre-wrap;
        white-space: -o-pre-wrap;
        word-wrap: break-word;
    }

    xmp { 
        white-space:pre-wrap; 
        word-wrap:break-word; 
    }*/

    .completed {
        font-family: "Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace;
        //font-size: 24px;
        font-style: normal;
        //font-variant: normal;
        font-weight: 500;
        background-color: #F6F6F6;
    }

    .table {
        background-color: #F6F6F6;
    }

    .notcompleted {
        font-family: "Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace;
        //font-size: 24px;
        font-style: normal;
        //font-variant: normal;
        font-weight: bold;
    }

    </style>

<body>
    <section class="section" id="todoapp">
        <div class="container">
            <div class="columns">
                <div class="column is-2"></div>       

                <div class="column">
<!--                     <form>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="field">
                            <div class="control">
                                <input 

                                class="new-todo input" 
                                type="text" 
                                id="user_input" 
                                name="user_input"
                                autofocus autocomplete="off"
                                placeholder=""
                                v-model="newTodo"
                                @keyup.enter="addTodo"
                                placeholder="">
                            </div>
                        </div>
                        <div class="field is-grouped">
                          <div class="control">
                            <!-- <button ic-put-to="button_click" class="button is-primary">Submit</button> -->
                            <!-- <a ic-post-to="mouse_entered" ic-trigger-on="mouseenter">Mouse Over Me!</a> -->
                            <!-- <a ic-post-to="mouse_entered" ic-target='#target_span' v-on:click="reverseMessage">Click Me!</a> --
                        </div>
                    </div>
                </form> -->

                <p class="subtitle">
                    <!-- Chat to me! -->
                </p>

<section class="todoapp">
  <section class="main" v-show="todos.length" v-cloak>

    <ul class="todo-list">
      <li v-for="todo in filteredTodos"
        class="todo"
        :key="todo.id">
        <br>
        <div class="view" v-bind:class="{ completed: todo.completed, notcompleted: !todo.completed}">
          <p v-html="todo.title"></p>
        </div>
      </li>
    </ul>
  </section>
  <br>
  <div class="field">
  <div class="control">
      <input class="new-todo input"
      autofocus autocomplete="off"
      placeholder=""
      v-model="newTodo"
      @keyup.enter="addTodo"
      :disabled="waitingForReply == true"
      >
  </div>
  </div>  

  <div class="field" v-show='newTodo == "tos"'>
  <div class="control" >
      <input class="name input"
      autofocus autocomplete="off"
      placeholder="name - vul hier de variabele in waarnaar verwezen moet worden."
      v-model="name"
      @keyup.enter="addTodo"
      >
  </div>
  </div>  

  <div class="field" v-show='newTodo == "tos"'>
  <div class="control" >
      <input class="new-todo input"
      autofocus autocomplete="off"
      placeholder="alternative name - vul hier het synoniem in wat de gebruiker kan gebruiken."
      v-model="alternativename"
      @keyup.enter="addTodo"
      >
  </div>
  </div>

  <div v-show='newTodo == "add"'><hr></div>
  <div class="field is-horizontal" v-show='newTodo == "add"'>
    <div class="field-label is-normal">
    <label class="label">Variable</label>
  </div>
  <div class="field-body control" >
      <input class="name input"
      autofocus autocomplete="off"
      placeholder=""
      v-model="variable"
      @keyup.enter="addTodo"
      >
  </div>
  </div>  

  <div class="field is-horizontal" v-show='newTodo == "add"'>
    <div class="field-label is-normal">
    <label class="label">Type</label>
  </div>
  <div class="field-body control" >
      <input class="new-todo input"
      autofocus autocomplete="off"
      placeholder=""
      v-model="type"
      @keyup.enter="addTodo"
      >
  </div>
  </div>

  <div class="field is-horizontal" v-show='newTodo == "add"'>
    <div class="field-label is-normal">
    <label class="label">Group</label>
  </div>
  <div class="field-body control" >
      <input class="new-todo input"
      autofocus autocomplete="off"
      placeholder=""
      v-model="group_name"
      @keyup.enter="addTodo"
      >
  </div>
  </div>

  <div class="field is-horizontal" v-show='newTodo == "add"'>
    <div class="field-label is-normal">
    <label class="label">Part of group</label>
  </div>
  <div class="field-body control" >
      <input class="new-todo input"
      autofocus autocomplete="off"
      placeholder=""
      v-model="part_of_group"
      @keyup.enter="addTodo"
      >
  </div>
  </div>

  <div class="field is-horizontal" v-show='newTodo == "add"'>
    <div class="field-label is-normal">
    <label class="label">Description</label>
  </div>
  <div class="field-body control" >
      <input class="new-todo textarea"
      autofocus autocomplete="off"
      placeholder=""
      v-model="description"
      @keyup.enter="addTodo"
      >
  </div>
  </div>

  <div class="field is-horizontal" v-show='newTodo == "add"'>
    <div class="field-label is-normal">
    <label class="label">Text</label>
  </div>
  <div class="field-body control" >
      <input class="new-todo textarea"
      autofocus autocomplete="off"
      placeholder=""
      v-model="text"
      @keyup.enter="addTodo"
      >
  </div>
  </div>

 <div v-show='newTodo == "addgm"'><hr></div>
  <div class="field is-horizontal" v-show='newTodo == "addgm"'>
    <div class="field-label is-normal">
    <label class="label">Group</label>
  </div>
  <div class="field-body control" >
      <input class="name input"
      autofocus autocomplete="off"
      placeholder=""
      v-model="part_of_group"
      @keyup.enter="addTodo"
      >
  </div>
  </div>  

  <div class="field is-horizontal" v-show='newTodo == "addgm"'>
    <div class="field-label is-normal">
    <label class="label">Title</label>
  </div>
  <div class="field-body control" >
      <input class="name input"
      autofocus autocomplete="off"
      placeholder=""
      v-model="word"
      @keyup.enter="addTodo"
      >
  </div>
  </div>  

  <div class="field is-horizontal" v-show='newTodo == "addgm"'>
    <div class="field-label is-normal">
    <label class="label">Text</label>
  </div>
  <div class="field-body control" >
      <input class="new-todo textarea"
      autofocus autocomplete="off"
      placeholder=""
      v-model="text"
      @keyup.enter="addTodo"
      >
  </div>
  </div>

<!--   <footer class="footer" v-show="todos.length" v-cloak>
    <span class="todo-count">
      <strong>@{{ remaining }}</strong> @{{ remaining | pluralize }} left
    </span>
    <ul class="filters">
      <li><a href="#/all" :class="{ selected: visibility == 'all' }">All</a></li>
      <li><a href="#/active" :class="{ selected: visibility == 'active' }">Active</a></li>
      <li><a href="#/completed" :class="{ selected: visibility == 'completed' }">Completed</a></li>
    </ul>
    <button class="clear-completed" @click="removeCompleted" v-show="todos.length > remaining">
      Clear completed
    </button>
  </footer> -->
</section>


            </div>        
            <div class="column is-2"></div>
        </div>
    </div>

</section>
</body>

<script type="text/javascript">
// Full spec-compliant TodoMVC with localStorage persistence
// and hash-based routing in ~120 effective lines of JavaScript.
localStorage.clear();
// localStorage persistence
var STORAGE_KEY = 'todos-vuejs-2.0'
var todoStorage = {
  fetch: function () {
    var todos = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]')
    todos.forEach(function (todo, index) {
      todo.id = index
    })
    todoStorage.uid = todos.length
    return todos
  },
  save: function (todos) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(todos))
  },
  delete: function () {
    var todos = '';
    return todos;
  }
}

// visibility filters
var filters = {
  all: function (todos) {
    return todos
  },
  active: function (todos) {
    return todos.filter(function (todo) {
      return !todo.completed
    })
  },
  completed: function (todos) {
    return todos.filter(function (todo) {
      return todo.completed
    })
  }
}

// app Vue instance
var app = new Vue({
  // app initial state
  data: {
    todos: todoStorage.delete(),
    todos: todoStorage.fetch(),
    newTodo: '',
    message: '',
    editedTodo: null,
    visibility: 'all',
    waitingForReply: false,

    name: '',
    alternativename: '',    

    variable: '',
    word: '',
    type: '',    
    group_name: '',
    part_of_group: '',    
    description: '',
    text: '',

  },

  // watch todos change for localStorage persistence
  watch: {
    todos: {
      handler: function (todos) {
        todoStorage.save(todos)
      },
      deep: true
    }
  },

  // computed properties
  // http://vuejs.org/guide/computed.html
  computed: {
    filteredTodos: function () {
      return filters[this.visibility](this.todos)
    },
    remaining: function () {
      return filters.active(this.todos).length
    },
    allDone: {
      get: function () {
        return this.remaining === 0
      },
      set: function (value) {
        this.todos.forEach(function (todo) {
          todo.completed = value
        })
      }
    }
  },

  filters: {
    pluralize: function (n) {
      return n === 1 ? 'item' : 'items'
    }
  },

  // methods that implement data logic.
  // note there's no DOM manipulation here at all.
  methods: {
    addTodo: function () {
      var value = this.newTodo && this.newTodo.trim()
      if (value == 'tos') {
        var name = this.name;
        var alternativename = this.alternativename;
      }
      if (value == 'add') {
        var variable = this.variable;
        var word = this.word;
        var type = this.type;
        var group_name = this.group_name;
        var part_of_group = this.part_of_group;
        var description = this.description;
        var text = this.text;
      }      
      if (value == 'addgm') {
        var word = this.word;
        //var description = this.word;
        var part_of_group = this.part_of_group;
        var text = this.text;
      }

     //if (name && alternativename) {
     //  console.log("ok, go save");
     //}

      if (!value) {
        return
      }
      this.todos.push({
        id: todoStorage.uid++,
        title: value,
        completed: false
      })
      this.newTodo = '';

      //this.message.todos = this.todos;
      //this.message.waitingForReply = this.waitingForReply;

      axios.post('/chatbot/public/mouse_entered', {
        message: value,

        name: name,
        alternativename: alternativename,        

        variable: variable,
        word: word,
        type: type,
        group_name: group_name,
        part_of_group: part_of_group,
        description: description,
        text: text,
      })
      .then(function (response) {
        console.log(this);
        var answer = response.data.text;
      
        if (!answer) {
          return
        }
        this.push({
          id: todoStorage.uid++,
          title: answer,
          completed: true
        });
      }.bind(this.todos))
      .catch(function (error) {
        console.log(error);
      });
    },    

    removeTodo: function (todo) {
      this.todos.splice(this.todos.indexOf(todo), 1)
    },

    editTodo: function (todo) {
      this.beforeEditCache = todo.title
      this.editedTodo = todo
    },

    doneEdit: function (todo) {
      if (!this.editedTodo) {
        return
      }
      this.editedTodo = null
      todo.title = todo.title.trim()
      if (!todo.title) {
        this.removeTodo(todo)
      }
    },

    cancelEdit: function (todo) {
      this.editedTodo = null
      todo.title = this.beforeEditCache
    },

    removeCompleted: function () {
      this.todos = filters.active(this.todos)
    }
  },

  // a custom directive to wait for the DOM to be updated
  // before focusing on the input field.
  // http://vuejs.org/guide/custom-directive.html
  directives: {
    'todo-focus': function (el, binding) {
      if (binding.value) {
        el.focus()
      }
    }
  },

  mounted() {
    axios.get('/chatbot/public/mouse_entered').then(response => console.log(response));
  }
})

// handle routing
function onHashChange () {
  var visibility = window.location.hash.replace(/#\/?/, '')
  if (filters[visibility]) {
    app.visibility = visibility
  } else {
    window.location.hash = ''
    app.visibility = 'all'
  }
}

window.addEventListener('hashchange', onHashChange)
onHashChange()

// mount
app.$mount('#todoapp')





</script>

</html>
