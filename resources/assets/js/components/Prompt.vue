<template>
  <div class="container">
    <div class="row">
      
      <div class="col-md-8 col-md-offset-2">
        <div class="panel" :class="'panel-' + type">
          <div class="panel-body  text-center" :class="'text-' + type">
            <h1> {{ title }} </h1>
            <h3> {{ message }} </h3>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
  export default {
    props: {
      type: {
        type: String,  // default|primary|success|info|warning|danger
        default: 'default'  
      },
      title: {
        type: String,
        default: ''
      },
      message: {
        type: String,
        default: 'Here goes some prompt'
      }
    }
  }
</script>
