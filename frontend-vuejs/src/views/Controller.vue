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
                                            <input type="checkbox"
                                                   @click="nodeChangeStatus(device.hashid, 'power', device.power)"
                                                   :disabled="!device.allowChange" :value="device.power"
                                                   v-model="device.power">
                                            <div class="slider round" data-off="Off" data-on="On"></div>
                                        </label>

                                        <label class="switch" v-if="device.power && device.allowChange">
                                            <input type="checkbox"
                                                   @click="nodeChangeStatus(device.hashid, 'speed', device.speed)"
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
    import qs from 'qs';

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
                devices: [],
                token: Date.now().toString() + 'abcdefghijklmnopqrstuvwxyz'
            }
        },
        methods: {
            nodeChangeStatus(hashid, action, status) {
                let task = null;
                if (action === 'power') {
                    if (!status)
                        task = 'power-on';
                    else
                        task = 'power-off';
                } else if (action === 'speed') {
                    if (!status)
                        task = 'speed-high';
                    else
                        task = 'speed-low';
                }

                const url = '/api';
                const data = {
                    token: this.masterToken(),
                    request: "newTask",
                    device: hashid,
                    task: task
                };

                axios.post(
                    url,
                    qs.stringify(data)
                ).then(response => {
                    this.fetchStates();
                })
                    .catch(function () {
                        console.log('FAILURE!!');
                    });
            },

            fetchStates() {
                const url = '/api';
                const data = {
                    token: this.masterToken(),
                    request: "GetStates",
                };

                axios.post(
                    url,
                    qs.stringify(data)
                ).then(response => {
                    this.data = response.data;
                    this.date = response.data.updated_at;
                    this.nodes = response.data.nodes;
                    this.status = response.data.status;
                    this.statusColor = response.data.statusColor;
                    this.devices = response.data.devices;
                })
                    .catch(function () {
                        console.log('FAILURE!!');
                    });
            },

            masterToken() {
                return process.env.VUE_APP_NODE_TOKEN;
            },
        },
        mounted() {
            this.fetchStates();
        },
        created() {
            setInterval(function () {
                this.fetchStates()
            }.bind(this), 10000);
        }
    };
</script>
