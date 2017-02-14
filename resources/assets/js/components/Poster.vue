<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          
          <div class="poster-heading col-md-12 text-center">
            <p>Hello, Dongyue</p>
          </div>

          <div class="row text-center">
            <div class="col-md-3">
              <h3><a href="#" @click="$emit('roll', 'teams')"> Teams </a></h3>
            </div>
            <div class="col-md-3">
              <h3><a href="#" @click="$emit('roll', 'addressBook')"> Members </a></h3>
            </div>
            <div class="col-md-3">
              <h3><a href="#"> Others </a></h3>
            </div>
            <div class="col-md-3">
              <h3><a href="#"> And others </a></h3>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<style>
  .poster-heading {
    padding: 70px 0;
    font-size: 60px;
  }
</style>