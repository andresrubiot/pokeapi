<template>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="row row-cols-1 row-cols-md-4">
        <div class="col mb-4" v-for="(pokemon, index) in pokemons" :key="'pokemon' + index">
          <div class="card text-center">
            <div class="card-body">
              <img :src="image + (Math.round(index+1)) + '.png'" width="150" class="p-3" :alt="pokemon.name">
              <h5 class="card-title">{{ pokemon.name }}</h5>
              <button class="btn btn-secondary btn-lin" :dusk="pokemon.name+'-info'" @click="viewPokemon(pokemon.url)">Info</button>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col--md-12">
          <button class="btn btn-primary btn-lg" @click="getNextPokemons" dusk="more">More</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    url: {
      type: String,
      required: true
    },

    image: {
      type: String,
      required: true
    }
  },

  data() {
    return {
      pokemons: [],
      nextUrl: ''
    }
  },

  methods: {
    getPokemons() {
      axios.get(this.url)
      .then( res => {
        this.nextUrl = res.data.next;

        res.data.results.forEach(pokemon => {
          this.pokemons.push(pokemon);
        })
      })
      .catch( err => {
        console.log(err);
      })
    },

    getNextPokemons() {
      axios.get(this.nextUrl)
      .then( res => {
        this.nextUrl = res.data.next;

        res.data.results.forEach(pokemon => {
          this.pokemons.push(pokemon);
        })
      });
    },

    viewPokemon(url) {
      this.$emit('viewPokemon', url);
    }
  },

  created() {
    this.getPokemons();
  }
}
</script>