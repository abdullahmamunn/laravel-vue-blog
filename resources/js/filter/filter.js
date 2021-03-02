
import Vue from 'vue';
// moment js
import moment from "moment";
Vue.filter('time', function (value) {
    // return moment(value).startOf('hour').fromNow();
    //    return moment(value).endOf('day').fromNow();
    return moment(value).format('Do-MMM-YY');
});

Vue.filter('subString', function (value, length) {
    return value.substring(0,length)
});

Vue.filter('capitalize', function (value) {
    if(!value)
    {
        return ''
    }
    else{
        value = value.toString()
        return value.charAt(0).toUpperCase() + value.slice(1)
    }
});
