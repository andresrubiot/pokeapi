<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card text-center position-fixed">
          <div class="card-body">
            <img src="images/pokeapi.png" class="img-thumbnail mb-3">
            <h3 class="card-title">{{ user.name }}</h3>
            <p class="text-muted">{{ user.email }}</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <form @submit.prevent="updateProfile()">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" dusk="name" v-model="form.name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                <has-error :form="form" field="name"></has-error>
              </div>

              <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="email" name="email" dusk="email" v-model="form.email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                <has-error :form="form" field="email"></has-error>
              </div>

              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" dusk="address" v-model="form.address" class="form-control" :class="{ 'is-invalid': form.errors.has('address') }">
                <has-error :form="form" field="address"></has-error>
              </div>

              <div class="form-group">
                <label for="birthdate">Birthdate</label>
                <input type="date" name="birthdate" dusk="birthdate" v-model="form.birthdate" class="form-control" :class="{ 'is-invalid': form.errors.has('birthdate') }">
                <has-error :form="form" field="birthdate"></has-error>
              </div>

              <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" dusk="city" v-model="form.city" class="form-control" :class="{ 'is-invalid': form.errors.has('city') }">
                <has-error :form="form" field="city"></has-error>
              </div>

              <button type="submit" class="btn btn-primary" dusk="update-btn">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: '',
      form: new Form({
        id: '',
        name: '',
        email: '',
        address: '',
        city: '',
        birthdate: ''
      })
    }
  },

  created() {
    this.$Progress.start();
    axios.get("api/profile")
    .then(({ data }) => (
      this.form.fill(data),
      this.user = data
      ))
    .catch(()=>{
      this.$Progress.fail();
    });
  },

  mounted() {
    this.$Progress.finish();
  },

  methods: {
    updateProfile() {
      this.$Progress.start();

      this.form.put('api/profile')
      .then( () => {
        this.show();
        this.$Progress.finish();
      })
      .catch( () => {
        this.$Progress.fail();
      });
    },

    show() {
      axios.get("api/profile")
      .then(({ data }) => (
        this.form.fill(data),
        this.user = data
        ))
      .catch(err => {
        console.log(err);
      });
    }
  }
}
</script>
