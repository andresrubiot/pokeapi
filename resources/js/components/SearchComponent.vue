<template>
    <div class="container py-3">
      <form @submit.prevent="viewPokemon">
        <div class="input-group">
          <input type="search" v-model="search" class="form-control" placeholder="Search pokemon" dusk="pokemon">
          <div class="input-group-append">
            <button class="btn btn-primary" @click="viewPokemon" dusk="search">Search</button>
          </div>
        </div>
      </form>
    </div>
</template>

<script>
export default {
  props: {
    url: {
      type: String,
      required: true
    }
  },

  data() {
    return {
      search: '',
    }
  },

  methods: {
    viewPokemon(url) {
      if(this.search !== ''){
        this.$emit('viewPokemon', this.url + this.search);
      }
    }
  }
}
</script>