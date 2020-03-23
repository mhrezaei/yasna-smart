<template>
    <div class="profile-page">
        <section class="section-profile-cover section-shaped my-0">
            <div class="shape shape-style-1 shape-primary shape-skew alpha-4"></div>
        </section>
        <section class="section section-skew">
            <div class="container">
                <card shadow class="card-profile mt--300" no-body>
                    <div class="px-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <a href="/">
                                        <img v-lazy="'img/theme/avatar.png'">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                                <div class="card-profile-actions py-4 mt-lg-0">
                                    <base-button type="info" size="sm" class="mr-4" @click="fetchStates">Refresh
                                    </base-button>
                                    <base-button type="warning" size="sm" class="float-right">Logout</base-button>
                                </div>
                            </div>
                            <div class="col-lg-4 order-lg-1">
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                        <span class="heading">
                                            <badge pill :type="statusColor">{{ status }}</badge>
                                        </span>
                                        <span class="description">Status</span>
                                    </div>
                                    <div>
                                        <span class="heading">
                                            <badge pill type="info">{{ date }}</badge>
                                        </span>
                                        <span class="description">Update</span>
                                    </div>
                                    <div>
                                        <span class="heading">
                                            <badge pill type="info" v-model="nodes">{{ nodes }}</badge>
                                        </span>
                                        <span class="description">Nodes</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 py-5 border-top">
                            <div class="container">

                                <div class="row border-bottom" style="padding-bottom: 8px; margin-bottom: 5px;"
                                     v-for="device in devices">
                                    <div class="col col-1">
                                        <i :class="'ni ' + device.icon"
                                           style="font-size: 20px; color: orange; padding-top: 6px;"></i>
                                    </div>
                                    <div class="col col-8">
                                        <div>{{ device.title }}</div>
                                        <badge pill type="success" v-if="device.power">Powered On</badge>
                                        <badge pill type="success" v-if="!device.power">Powered Off</badge>
                                        <badge pill type="warning"
                                               v-if="device.power && !device.speed && device.allowChange">Low
                                        </badge>
                                        <badge pill type="danger" v-if="device.power && device.speed">High</badge>
                                    </div>
                                    <div class="col col-3" style="padding-top: 10px;">
                                        <label class="switch">
                                            <input type="checkbox" @click="conditionStatus(device.hashid, 'power')"
                                                   :disabled="!device.allowChange" :value="device.power"
                                                   v-model="device.power">
                                            <div class="slider round" data-off="Off" data-on="On"></div>
                                        </label>

                                        <label class="switch" v-if="device.power && device.allowChange">
                                            <input type="checkbox" @click="conditionStatus(device.hashid, 'speed')"
                                                   :value="device.speed" v-model="device.speed">
                                            <div class="slider round" data-off="Low" data-on="High"></div>
                                        </label>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </card>
            </div>
        </section>
    </div>
</template>
<script>
    import "../assets/vendor/nucleo/css/nucleo.css";
    import "../assets/vendor/font-awesome/css/font-awesome.css";
    import "../assets/scss/argon.scss";
    import axios from "axios";

    export default {
        data() {
            return {
                nodes: 0,
                status: 'Connected',
                statusColor: 'success',
                date: '2020-12-11 17:23:58',
                devices: [
                    {
                        icon: 'ni-ui-04',
                        title: 'Programings Room Air Condition',
                        allowChange: true,
                        power: false,
                        speed: false,
                        hashid: 'abcds'
                    },
                    {
                        icon: 'ni-ui-04',
                        title: 'Main Hall Air Condition',
                        allowChange: true,
                        power: false,
                        speed: false,
                        hashid: 'sdcxcs'
                    },
                    {
                        icon: 'ni-bulb-61',
                        title: 'Programings Room Light One',
                        allowChange: true,
                        power: false,
                        speed: false,
                        hashid: 'sdcxsscs'
                    },
                    {
                        icon: 'ni-bulb-61',
                        title: 'Programings Room Light Two',
                        allowChange: true,
                        power: false,
                        speed: false,
                        hashid: 'sdcsxsscs'
                    },
                    {
                        icon: 'ni-umbrella-13',
                        title: 'Irrigation of flowers and balcony plants',
                        allowChange: false,
                        power: true,
                        speed: false,
                        hashid: 'sdcsxsscas'
                    },

                ],
            }
        },
        methods: {
            conditionStatus(hashid, action) {
                this.devices.forEach(function (device, index) {
                    if (device.hashid === hashid) {
                        if (action === 'power') {
                            device.power = !device.power;
                            if (!device.power) {
                                device.speed = false;
                            }
                        } else if (action === 'speed') {
                            device.speed = !device.speed;
                        }
                    }
                });
            },

            fetchStates() {
                axios.post('http://yasna.smart/yasna.php',
                    {
                        token: "ihjfkghxkfdgxdfgxfgffgxdfg",
                        request: "GetStates",
                    },
                {
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'Access-Control-Allow-Origin': 'http://yasna.smart'
                        },
                    }
                ).then(function () {
                    console.log('SUCCESS!!');
                })
                .catch(function () {
                    console.log('FAILURE!!');
                });
            },
        },
    };
</script>
<style>
</style>
