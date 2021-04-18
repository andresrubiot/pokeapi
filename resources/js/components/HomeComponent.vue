<template>
  <div class="container">
    <h1>Pokemon list</h1>
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="row row-cols-1 row-cols-md-4">
          <div class="col mb-4" v-for="(pokemon, index) in pokemons" :key="'pokemon' + index">
            <div class="card text-center">
              <div class="card-body">
                <img :src="'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/' + (Math.round(index+1)) + '.png'" width="150" class="p-3" :alt="pokemon.name">
                <h5 class="card-title">{{ pokemon.name }}</h5>
                <p class="card-text text-muted">
                  Info
                </p>
              </div>
            </div>
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
      pokemons: [],
    }
  },

  methods: {
    getPokemons() {
      axios.get('https://pokeapi.co/api/v2/pokemon/')
      .then( res => {
        console.log(res.data.results);
        res.data.results.forEach(pokemon => {
          this.pokemons.push(pokemon);
        })
      })
      .catch( err => {
        console.log(err);
      })
    }
  },

  created() {
    this.getPokemons();
  }
}
</script>