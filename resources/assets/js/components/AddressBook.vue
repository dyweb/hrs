<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <table  class="table table-bordered table-hover">
          <thead v-if="members">
            <tr>
              <td v-for="(value, key) in members[0]">{{ key }}</td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="member in members">
              <td v-for="value in member">{{ value }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['members']
  }
</script>
