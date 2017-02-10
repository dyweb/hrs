<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table  class="table table-bordered table-hover">
                    <thead>
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
        data () {
            return {
                members: []
            } 
        },
        created () {
            let self = this

            axios.get('/members')
                .then(function (response) { 
                    self.members = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }
</script>
