<template>
    <footer class="footer has-cards">
        <div class="container">
            <div class="row align-items-center justify-content-md-between">
                <div class="col-md-12">
                    <div class="copyright text-center">
                        &copy; {{year}}
                        <a href="https://yasna.team" target="_blank" rel="noopener">YasnaTeam Copyright</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>
<script>
    export default {
        name: 'app-footer',
        data() {
            return {
                year: new Date().getFullYear()
            }
        }
    };
</script>
<style>
</style>
