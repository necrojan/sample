<template>
    <div>
        <h3>Car Catalog</h3>
        <div class="row mb-4">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                Filter by Make:
                <select @change="onSelect($event)" class="custom-select">
                    <option v-for="maker in allMakers" :value="maker">{{ maker }}</option>
                </select>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-6">
                <div v-if="cars" v-for="car in cars" class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div @click="getCar(car.id)" class="panel-heading" role="tab" id="heading">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" :href="'#collapse'+car.id" aria-expanded="false" :aria-controls="'collapse'+car.id">
                                    {{ car.year }} {{ car.make }} {{ car.model }}
                                </a>
                            </h4>

                        </div>
                        <div :id="'collapse'+car.id" class="panel-collapse collapse" role="tabpanel" :aria-labelledby="'heading'+car.id">
                            <div v-if="carData && carData.id == car.id" class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div v-if="carData.image">
                                            <img :src="carData.image" alt="carData.model" style="width: 50%">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Price: {{ carData.price }}</p>
                                        <p>MPG: {{ carData.mpg }}</p>
                                        <p>Seats: {{ carData.seats }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">&nbsp;</div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            cars: [],
            carData: null,
            token: '',
            allMakers: ['Toyota', 'Honda', 'Ford', 'Ferrari']
        }
    },

    mounted() {
        this.getCars();
    },

    methods: {
        getCars(make = '') {
            axios.get(`/cars?make=${make}`).then((res) => {
                this.cars = res.data.cars.cars;
                this.token = res.data.token;
            })
        },

        getCar(id) {
            console.log('id', id);
            axios.post(`/cars/${id}`, {
                'token': this.token
            }).then((res) => {
                this.carData = res.data;
            })
        },

        onSelect(event) {
            this.getCars(event.target.value);
        }
    }
}
</script>

<style scoped>
@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");
.panel-title > a:before {
    float: right !important;
    font-family: FontAwesome;
    content:"\f068";
    padding-right: 5px;
}
.panel-title > a.collapsed:before {
    float: right !important;
    content:"\f067";
}
.panel-title > a:hover,
.panel-title > a:active,
.panel-title > a:focus  {
    text-decoration:none;
}
</style>
