<template>
    <div class="profile-page">
        <cover-section></cover-section>
        <section class="section section-skew">
            <div class="container">
                <card shadow class="card-profile mt--300" no-body>
                    <div class="px-4">
                        <div class="row justify-content-center">
                            <profile-picture></profile-picture>
                            <buttons-section :fetch-states="fetchStates"></buttons-section>
                            <devices-info :statusColor="statusColor" :nodes="nodes" :status="status"
                                          :date="date"></devices-info>
                        </div>

                        <div class="mt-5 py-5 border-top">
                            <div class="container">

                                <div class="row border-bottom device-divider"
                                     v-for="device in devices">
                                    <div class="col col-1">
                                        <i :class="'icons ni ' + device.icon"></i>
                                    </div>
                                    <div class="col col-8">
                                        <div>{{ device.title }}</div>
                                        <badger :type="'success'" :condition="device.power"
                                                :label="'Powered On'"></badger>
                                        <badger :type="'success'" :condition="!device.power"
                                                :label="'Powered Off'"></badger>
                                        <badger :type="'warning'"
                                                :condition="device.power && !device.speed && device.allowChange"
                                                :label="'Low'"></badger>
                                        <badger :type="'danger'" :condition="device.power && device.speed"
                                                :label="'High'"></badger>

                                    </div>
                                    <div class="col col-3">
                                        <label class="switch">
                                            <input type="checkbox" @click="nodeChangeStatus(device.hashid, 'power')"
                                                   :disabled="!device.allowChange" :value="device.power"
                                                   v-model="device.power">
                                            <div class="slider round" data-off="Off" data-on="On"></div>
                                        </label>

                                        <label class="switch" v-if="device.power && device.allowChange">
                                            <input type="checkbox" @click="nodeChangeStatus(device.hashid, 'speed')"
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
    import "../assets/scss/argon.scss";
    import coverSection from "./components/CoverSection";
    import profilePicture from "./components/ProfilePicture";
    import buttonsSection from "./components/ButtonsSection";
    import devicesInfo from "./components/DevicesInfo";
    import badger from "./components/Badger";
    import axios from "axios";

    export default {
        components: {
            coverSection,
            profilePicture,
            buttonsSection,
            devicesInfo,
            badger,
        },
        data() {
            return {
                nodes: 10,
                status: 'Connected',
                statusColor: 'success',
                date: '2020-12-11 17:23:58',
                devices: [
                    {
                        icon: 'ni-ui-04',
                        title: 'Programmers Room Air Conditioner ',
                        allowChange: true,
                        power: false,
                        speed: false,
                        hashid: 'abcds'
                    },
                    {
                        icon: 'ni-ui-04',
                        title: 'Main Hall Air Conditioner',
                        allowChange: true,
                        power: false,
                        speed: false,
                        hashid: 'sdcxcs'
                    },
                    {
                        icon: 'ni-bulb-61',
                        title: 'Programmers Room Light One',
                        allowChange: true,
                        power: false,
                        speed: false,
                        hashid: 'sdcxsscs'
                    },
                    {
                        icon: 'ni-bulb-61',
                        title: 'Programmers Room Light Two',
                        allowChange: true,
                        power: false,
                        speed: false,
                        hashid: 'sdcsxsscs'
                    },
                    {
                        icon: 'ni-umbrella-13',
                        title: 'Automatic watering of flowers and plants',
                        allowChange: false,
                        power: true,
                        speed: false,
                        hashid: 'sdcsxsscas'
                    },

                ],
                token: Date.now().toString() + 'abcdefghijklmnopqrstuvwxyz'
            }
        },
        methods: {
            nodeChangeStatus(hashid, action) {
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
                axios.post('api/yasna.php',
                    {
                        token: this.token,
                        request: "GetStates",
                    },
                    {
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
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
