
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import 'select2/dist/css/select2.min.css';
window.Vue = require('vue');

Vue.set(Vue.prototype, '_', _);

Vue.config.devtools = true;
Vue.config.debug = true;
Vue.config.silent = false;


var SS;


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

function fetchClasses() {
    return axios.get(BASE_URL + '/api/classes', {
        responseType: 'json', // default
        params: {
            with_relationships: true
        }
    });
}

function fetchTeachers() {
    return axios.get(BASE_URL + '/api/teachers', {
        responseType: 'json', // default
    });
}

function fetchStudents() {
    return axios.get(BASE_URL + '/api/students', {
        responseType: 'json', // default,
        params: {
            with_relationships: true
        }
    });
}

const app = new Vue({
    el: '#app',
    data: {
        allClasses: null,
        allTeachers: null,
        allStudents: null,
        year: 0,
        selectedClasses: [],
        selectedClassID: null,
        selectedStudentID: null,
        selectedTeacherID: null
    },
    computed: {
        /* Filters `classes` collection based on year */
        classes: function() {
            let _self = this;
            if(null == _self.allClasses) return null;
            return isNaN(_self.year) ? 
                _self.allClasses : 
                _self.allClasses.filter(function(cls) {
                    return cls.year == _self.year;
                });
        },
        selectedStudent: function() {
            let _self = this;
            if(null == _self.selectedStudentID) return null;
            return _self.allStudents.find(function(student){
                return student.id == _self.selectedStudentID;
            });
        },
        selectedClass: function() {
            let _self = this;
            if(null == _self.selectedClassID) return null;
            return _self.allClasses.find(function(cls){
                return cls.id == _self.selectedClassID;
            });
        }
    },
    beforeMount: function() {
        let _self = this;

        if (!supportsLocalStorage()) {
            window.sessionStorage = {
                _data: {},
                setItem: function(id, val) { return this._data[id] = String(val); },
                getItem: function(id) { return this._data.hasOwnProperty(id) ? this._data[id] : undefined; },
                removeItem: function(id) { return delete this._data[id]; },
                clear: function() { return this._data = {}; }
            };
        }
        SS = window.sessionStorage;

        if (SS.getItem('classes') === null || SS.getItem('teachers') === null || SS.getItem('students') === null) {
            axios.all([fetchClasses(), fetchTeachers(), fetchStudents()])
                .then(axios.spread(function(resClasses, resTeachers, resStudents){
                    _self.allClasses = resClasses.data;
                    SS.setItem('classes', JSON.stringify(resClasses.data));

                    _self.allTeachers = resTeachers.data;
                    SS.setItem('teachers', JSON.stringify(resTeachers.data));

                    _self.allStudents = resStudents.data;
                    SS.setItem('students', JSON.stringify(resStudents.data));

                })).catch(function(errClasses, errTeachers, errStudents){
                    console.log(errClasses);
                    console.log(errTeachers);
                    console.log(errStudents);
                });
        } else {
            _self.allClasses = JSON.parse(SS.getItem('classes'));
            _self.allTeachers = JSON.parse(SS.getItem('teachers'));
            _self.allStudents = JSON.parse(SS.getItem('students'));
        }
    },
    mounted: function() {
        jQuery('.custom-select').select2();
        jQuery('.custom-select-multiple').select2();

        jQuery('.custom-select-multiple').on('change', function(e) {
            var currentOptGroupId = e.params.data.element.parentElement.id;
            $(this).find('optgroup').not(currentOptGroupId).find('option').attr('disabled', 'disabled');
        });
    }
});
