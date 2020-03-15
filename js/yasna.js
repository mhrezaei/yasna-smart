let yasna = {
    base_url(ext)
    {
        var url     = window.location.href,
            base    = url.substring(0, url.indexOf('/', 14)),
            base = base + "/smart-yasna";
            ret_url = base + "/";

        if(ext !== undefined && ext !== '') {
            ret_url += ext;
        }

        return ret_url;
    },

    token(){
        let token = Date.now() + "jsdhdfg7465uxncsdg";
        return token.toString();
    },

    toggleSwitchs(element, action) {
        element.bootstrapToggle(action);
    },

    coolingControlls(states) {
        yasna.coolingControll('cooling1', '#cooling1');
        yasna.coolingControll('cooling2', '#cooling2');
        yasna.coolingControll('cooling3', '#cooling3');
    },

    coolingControll(state, element) {
        let cool = $(element);
        let cooling_state = $(element + '_state');
        let cooling_alert = $(element + '_alert');

        this.toggleSwitchs(cool, 'off');
        this.toggleSwitchs(cooling_state, 'off');
        this.toggleSwitchs(cooling_state, 'disable');
        cooling_alert.hide();

        if(state.power == 'on')
        {
            this.toggleSwitchs(cool, 'on');
            this.toggleSwitchs(cooling_state, 'enable');

            if(state.speed == 'low')
            {
                this.toggleSwitchs(cooling_state, 'off');
            }
            else
            {
                this.toggleSwitchs(cooling_state, 'on');
            }
        }
        else
        {
            this.toggleSwitchs(cool, 'off');
            this.toggleSwitchs(cooling_state, 'disable');
        }

        if(state.error !== 'no')
        {
            cooling_alert.hide();
        }
        else
        {
            cooling_alert.show();
        }
        
    },

    getData() {
        let timer = 3000;
        $.ajax({
            dataType: "json",
            type: "POST",
            url: yasna.base_url() + "/yasna.php",
            cache: false,
            data: {
                token: this.token(),
                request: 'getStates'
            }
            }).done(function(Data){
                let states = Data;
                if(states.status == 200)
                {
                    $('#time').text(states.time);
                }
                yasna.coolingControlls(states)
            });
            setTimeout(function(){
                //yasna.getData();
            }, timer);
    },
}

yasna.getData();