webpackJsonp([1],{"3dN6":function(t,e){},"8eHi":function(t,e){},Hsze:function(t,e){},IcS4:function(t,e){},J8kE:function(t,e){},NHnr:function(t,e,s){"use strict";Object.defineProperty(e,"__esModule",{value:!0});s("3dN6");var a=s("/zV6"),n=s.n(a),o=s("2EC8"),r=s.n(o),i=s("7+uW"),c=s("/ocq"),l={name:"App",components:{},created:function(){this.setDisabled()},data:function(){return{overlay:!1,show:!1}},computed:{isDisabled:function(){return this.$store.getters.getDisabled},logged:function(){return!!this.$store.getters.getCode},personal:function(){return this.$store.getters.getPersonal}},methods:{toggle:function(){this.overlay=!this.overlay,this.show=!this.show},setDisabled:function(){this.$store.commit("setDisabled",!1)},goToHome:function(){console.log("go"),this.$router.push({name:"home"})}},watch:{$route:function(t,e){this.setDisabled()}}},u={render:function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{attrs:{id:"app"}},[s("nav",{staticClass:"uk-navbar-container uk-navbar",class:{disabled:t.isDisabled},attrs:{"uk-navbar":""}},[s("div",{staticClass:"uk-navbar-orion-mobil"},[s("span",{staticClass:"uk-margin-small-right uk-navbar-orion-mobil__burguer",attrs:{"uk-icon":"icon: menu; ratio: 2"},on:{click:t.toggle}}),t._v(" "),s("h1",{staticClass:"uk-navbar-orion-mobil__title"},[t._v("Orion")]),t._v(" "),t._m(0)]),t._v(" "),s("div",{staticClass:"uk-navbar-left uk-navbar-left-orion",on:{click:t.goToHome}},[s("span",{staticClass:"uk-navbar-item uk-logo",attrs:{href:""}},[t._v("Orion")])]),t._v(" "),s("div",{staticClass:"uk-navbar-right uk-navbar-right-orion"},[s("ul",{staticClass:"uk-navbar-nav"},[t.logged?s("li",{staticClass:"uk"},[s("router-link",{attrs:{to:{name:"home"}}},[t._v("INICIO")])],1):t._e(),t._v(" "),t.logged?t._e():s("li",{staticClass:"uk"},[s("router-link",{attrs:{to:{name:"login"}}},[t._v("INICIAR SESION")])],1),t._v(" "),t.logged?t._e():s("li",{staticClass:"uk"},[s("router-link",{attrs:{to:{name:"register"}}},[t._v("REGISTRARSE")])],1),t._v(" "),t.logged?s("li",{staticClass:"uk"},[s("router-link",{attrs:{to:{name:"logout"}}},[t._v("Cerrar sesion")])],1):t._e()])])]),t._v(" "),s("aside",{staticClass:"aside",class:{show:t.show}},[t._l(t.personal,function(e,a){return s("div",{key:a,staticClass:"aside__personal-container"},[t._m(1,!0),t._v(" "),s("h2",{staticClass:"aside__personal-container__name"},[t._v(t._s(e.name)+" "+t._s(e.apaterno)+" "+t._s(e.amaterno))])])}),t._v(" "),s("ul",{staticClass:"aside__ul",on:{click:t.toggle}},[s("li",{staticClass:"aside__ul__li"},[s("router-link",{staticClass:"aside__ul__li__link",attrs:{to:{name:"home"}}},[s("span",{staticClass:"aside__ul__li__link__icon",attrs:{"uk-icon":"icon: home"}}),t._v(" "),s("p",{staticClass:"aside__ul__li__link__title"},[t._v("Inicio")])])],1),t._v(" "),s("li",{staticClass:"aside__ul__li"},[s("router-link",{staticClass:"aside__ul__li__link",attrs:{to:{name:"login"}}},[s("span",{staticClass:"aside__ul__li__link__icon",attrs:{"uk-icon":"icon: home"}}),t._v(" "),s("p",{staticClass:"aside__ul__li__link__title"},[t._v("Iniciar sesion")])])],1),t._v(" "),s("li",{staticClass:"aside__ul__li"},[s("router-link",{staticClass:"aside__ul__li__link",attrs:{to:{name:"register"}}},[s("span",{staticClass:"aside__ul__li__link__icon",attrs:{"uk-icon":"icon: file-edit"}}),t._v(" "),s("p",{staticClass:"aside__ul__li__link__title"},[t._v("Registrarse")])])],1),t._v(" "),s("li",{staticClass:"aside__ul__li"},[s("router-link",{staticClass:"aside__ul__li__link",attrs:{to:{name:"logout"}}},[s("span",{staticClass:"aside__ul__li__link__icon",attrs:{"uk-icon":"icon: sign-out"}}),t._v(" "),s("p",{staticClass:"aside__ul__li__link__title"},[t._v("Cerrar sesion")])])],1)])],2),t._v(" "),t.overlay?s("div",{staticClass:"overlay",on:{click:t.toggle}}):t._e(),t._v(" "),s("main",{staticClass:"main"},[s("router-view")],1)])},staticRenderFns:[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"level"},[e("span",{staticClass:"uk-margin-small-right uk-navbar-orion-mobil__burguer",attrs:{"uk-icon":"icon: menu; ratio: 2"}})])},function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"aside__personal-container__icon-container"},[e("span",{staticClass:"aside__personal-container__icon-container__icon",attrs:{"uk-icon":"icon: user; ratio: 3"}})])}]};var _=s("VU/8")(l,u,!1,function(t){s("nzR+")},null,null).exports,d={name:"Home",created:function(){this.$store.getters.getHomeAlreadyFirstLoaded?(console.log("La informacion de sections ya esta en la app"),this.evaluateSections()):(console.log("Status de Sections aun no estan en app, mandando a pedir al servidor"),this.$store.commit("setHomeAlreadyFirstLoaded",!0),this.getAll()),this.$store.getters.getShowMessageSectionCompleted.status&&this.showMessageSectionCompleted(),this.goToSectionWatcher=!1},data:function(){return{welcome:"Bienvenido",goToSectionWatcher:!1,page:-1}},computed:{sections:function(){return this.$store.getters.getSections},questions:function(){return this.$store.getters.getQuestions}},methods:{getAll:function(){var t=this;this.$store.dispatch("getSections").then(function(e){t.$store.commit("setSections",e),t.evaluateSections()})},goToSection:function(t){var e=t+1;this.page=e;var s=this.$store.getters.getSectionsData;if(0==s.length)console.log("Sections totalmente vacio"),this.getSectionDataFromServer(e);else{console.log("Sections no esta vacio, se buscara");var a=s.find(function(t){return t.questions.current_page==e});void 0==a?(console.log("Section no encontrado, mandando a buscar al servidor"),this.getSectionDataFromServer(e)):(console.log("Datos de la seccion encontrado en la aplicacion"),this.$store.commit("setSectionData",a),this.goToSectionWatcher=!0)}},getSectionDataFromServer:function(t){var e=this;this.$store.dispatch("getSectionData",t).then(function(t){e.$store.commit("setSectionsData",t),e.$store.commit("setSectionData",t),e.goToSectionWatcher=!0}).catch(function(t){console.log(t.status),401==t.status?Swal.fire("El administrador desactivo las encuestas","Para mas informacion favor de contactarse con el administrador","error"):Swal.fire("Problemas en el servidor","Porfavor intente mas tarde","error")})},evaluate:function(t){1==this.$store.getters.getSections[t]?Swal.fire("Encuesta contestada"):this.goToSection(t)},prueba:function(){Swal.fire({title:"Error!",text:"Do you want to continue",icon:"error",confirmButtonText:"Cool"})},showMessageSectionCompleted:function(){var t=this;Swal.fire({position:"top-end",icon:"success",title:"Seccion "+t.$store.getters.getShowMessageSectionCompleted.section+" contestada",showConfirmButton:!1,timer:1500}).then(function(e){t.$store.commit("setShowMessageSectionCompleted",{status:!1,section:null})})},evaluateSections:function(){var t=this.sections.reduce(function(t,e){return t+e}),e=this.sections.length;console.log("Suma del array sections: "+t),console.log("Tamaño del array sections: "+e),t==e&&(console.log("Vamos a finished"),this.$router.push({name:"finished"}))}},watch:{goToSectionWatcher:function(){if(1==this.goToSectionWatcher){this.$store.getters.getSectionData.sectionStatus[0].answered;this.$router.push({path:"cuestionario/"+this.page+"/dashboard"}),this.goToSectionWatcher=!1}}}},m={render:function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"home"},[s("div",{staticClass:"home__wrapper"},t._l(t.sections,function(e,a){return s("section",{key:a,staticClass:"home__wrapper__section",on:{click:function(e){return t.evaluate(a)}}},[s("div",{staticClass:"section",class:{green:e,warning:!e}},[s("div",{staticClass:"section__data"},[s("h2",{staticClass:"section__data__title"},[t._v("Sección "+t._s(a+1))]),t._v(" "),s("h3",{staticClass:"section__data__status"},e?[t._v("Contestado")]:[t._v("Pendiente")])]),t._v(" "),s("div",{staticClass:"section__image"},[s("div",{staticClass:"section__image__circle",class:{green:e,warning:!e}},[s("span",e?{staticClass:"uk-icon-link",attrs:{"uk-icon":"icon: check; ratio: 2"}}:{staticClass:"uk-icon-link clock",attrs:{"uk-icon":"icon: clock; ratio: 2"}})])])])])}),0)])},staticRenderFns:[]};var p=s("VU/8")(d,m,!1,function(t){s("IcS4")},"data-v-371183ef",null).exports,v={name:"Login",data:function(){return{welcome:"Bienvenido",code:""}},methods:{login:function(){var t=this.code,e=this.$router,s=this.$store;this.$store.dispatch("login",this.code).then(function(a){sessionStorage.setItem("access_code",t),s.commit("setCode",t),e.push({name:"home"})}).catch(function(t){console.log(t.response)})}}},g={render:function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"login"},[s("div",{staticClass:"login__wrapper"},[t._m(0),t._v(" "),s("div",{staticClass:"login__wrapper__form-container"},[s("form",{staticClass:"login__wrapper__form-container__form",on:{submit:function(e){return e.preventDefault(),t.login(e)}}},[s("div",{staticClass:"uk-margin login__wrapper__form-container__form__input-container"},[s("div",{staticClass:"uk-inline"},[s("span",{staticClass:"uk-form-icon",attrs:{"uk-icon":"icon: user"}}),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.code,expression:"code"}],staticClass:"uk-input",attrs:{type:"text",placeholder:"Codigo"},domProps:{value:t.code},on:{input:function(e){e.target.composing||(t.code=e.target.value)}}})])]),t._v(" "),s("button",{staticClass:"uk-button uk-button-primary"},[t._v("Ingresar")])])])])])},staticRenderFns:[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"login__wrapper__logo-container"},[e("span",{attrs:{"uk-icon":"icon:  users; ratio: 8"}})])}]};var f=s("VU/8")(v,g,!1,function(t){s("XR+H")},"data-v-a0f75652",null).exports,h={name:"Logout",created:function(){this.$store.commit("setCode",null),sessionStorage.removeItem("access_code"),this.$store.commit("logout"),this.$router.push({name:"login"})},data:function(){return{welcome:"Bienvenido"}}},C={render:function(){this.$createElement;this._self._c;return this._m(0)},staticRenderFns:[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"logout"},[e("div",{staticClass:"aksldj"},[this._v("Aqui va el logout")])])}]};var w=s("VU/8")(h,C,!1,function(t){s("J8kE")},null,null).exports,b=s("fZjL"),k=s.n(b),S=s("Dd8w"),y=s.n(S),$=s("sUu7"),q=s("wGWZ");Object($.c)("empty",{validate:function(t){return t.length>5},message:"Ingresa tu nombre"}),Object($.c)("secret",{validate:function(t){return"example"===t},message:"This is not the magic word"}),Object($.c)("positive",{validate:function(t){return{required:!0,valid:t.length>4}},computesRequired:!0}),Object($.c)("email",q.a),Object($.c)("email",y()({},q.a,{message:"Porfavor ingresa un correo valido"})),Object($.c)("required",y()({},q.b,{message:"Este campo es obligatorio"}));var D={name:"Register",components:{ValidationProvider:$.b,ValidationObserver:$.a},created:function(){var t=this,e=this;null!=this.rememberCode&&Swal.fire({title:this.rememberCode,text:"Olvidaste tu codigo?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Iniciar sesion",cancelButtonText:"Registro"}).then(function(t){t.value&&e.$router.push("/home",null,function(t){})}),this.$store.dispatch("getRegisterData").then(function(e){t.genders=e.genders,t.ms=e.marital,t.jobs=e.jobs}).catch(function(e){t.launchNotification()})},data:function(){return{welcome:"Bienvenido",name:"",apaterno:"",amaterno:"",gender:"",marital:"",birthday:"",job:"",email:"",genders:null,ms:null,jobs:null,errors:[],errorServer:null,loading:!1,code:null}},computed:{rememberCode:function(){return this.$store.getters.getRememberCode}},methods:{launchNotification:function(){UIkit.notification({message:"Error, porfavor intente mas tarde",status:"danger",pos:"top-center",timeout:5e3})},onSubmit:function(){var t=this,e=this;e.loading=!0,this.$store.dispatch("storeUser",{name:this.name,apaterno:this.apaterno,amaterno:this.amaterno,gender:this.gender,marital:this.marital,birthday:this.birthday,job:this.job,email:this.email}).then(function(s){e.code=s,e.loading=!1,t.$store.commit("setRememberCode",s),Swal.fire({icon:"success",title:s,text:"Registro exitoso, porfavor copie su codigo de usuario para proceder a iniciar sesion"}).then(function(e){t.$router.push({name:"login"})}),console.log(s)}).catch(function(s){if(e.loading=!1,t.errors=[],422==s.status){var a=s.data,n=t;console.log(a),k()(a.errors).forEach(function(t){var e=a.errors[t];n.errors.push(e[0])}),scroll(0,0)}else t.errors.push("Error, porfavor intentelo mas tarde"),t.launchNotification()})}}},x={render:function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"register"},[s("div",{staticClass:"register__wrapper"},[t.errors.length?s("div",{staticClass:"register__wrapper__error-container"},[s("div",{staticClass:"uk-alert-danger",attrs:{"uk-alert":""}},[s("a",{staticClass:"uk-alert-close",attrs:{"uk-close":""}}),t._v(" "),t._l(t.errors,function(e,a){return s("p",{key:a},[t._v("- "+t._s(e))])})],2)]):t._e(),t._v(" "),s("ValidationObserver",{staticClass:"register__wrapper__vo",scopedSlots:t._u([{key:"default",fn:function(e){var a=e.handleSubmit;return[s("form",{staticClass:"register__wrapper__vo__form",on:{submit:function(e){return e.preventDefault(),a(t.onSubmit)}}},[s("ValidationProvider",{staticClass:"register__wrapper__vo__form__vp",attrs:{rules:"required"},scopedSlots:t._u([{key:"default",fn:function(e){var a=e.errors;return[s("label",{staticClass:"register__wrapper__vo__form__vp__label",attrs:{for:"form-stacked-text"}},[t._v("Nombre")]),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.name,expression:"name"}],staticClass:"register__wrapper__vo__form__vp__input uk-input",attrs:{type:"text",name:"name"},domProps:{value:t.name},on:{input:function(e){e.target.composing||(t.name=e.target.value)}}}),t._v(" "),s("span",{staticClass:"register__wrapper__vo__form__vp__error uk-text-danger"},[t._v(t._s(a[0]))])]}}],null,!0)}),t._v(" "),s("ValidationProvider",{staticClass:"register__wrapper__vo__form__vp",attrs:{rules:"required"},scopedSlots:t._u([{key:"default",fn:function(e){var a=e.errors;return[s("label",{staticClass:"register__wrapper__vo__form__vp__label",attrs:{for:"form-stacked-text"}},[t._v("Apellido Paterno")]),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.apaterno,expression:"apaterno"}],staticClass:"register__wrapper__vo__form__vp__input uk-input",attrs:{type:"text",name:"apaterno"},domProps:{value:t.apaterno},on:{input:function(e){e.target.composing||(t.apaterno=e.target.value)}}}),t._v(" "),s("span",{staticClass:"register__wrapper__vo__form__vp__error uk-text-danger"},[t._v(t._s(a[0]))])]}}],null,!0)}),t._v(" "),s("ValidationProvider",{staticClass:"register__wrapper__vo__form__vp",scopedSlots:t._u([{key:"default",fn:function(e){var a=e.errors;return[s("label",{staticClass:"register__wrapper__vo__form__vp__label",attrs:{for:"form-stacked-text"}},[t._v("Apellido Materno")]),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.amaterno,expression:"amaterno"}],staticClass:"register__wrapper__vo__form__vp__input uk-input",attrs:{type:"text",name:"amaterno"},domProps:{value:t.amaterno},on:{input:function(e){e.target.composing||(t.amaterno=e.target.value)}}}),t._v(" "),s("span",{staticClass:"register__wrapper__vo__form__vp__error uk-text-danger"},[t._v(t._s(a[0]))])]}}],null,!0)}),t._v(" "),s("ValidationProvider",{staticClass:"register__wrapper__vo__form__vp",attrs:{rules:"email"},scopedSlots:t._u([{key:"default",fn:function(e){var a=e.errors;return[s("label",{staticClass:"register__wrapper__vo__form__vp__label",attrs:{for:"form-stacked-text"}},[t._v("Correo Electronico (opcional)")]),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.email,expression:"email"}],staticClass:"register__wrapper__vo__form__vp__input uk-input",attrs:{type:"text",name:"email"},domProps:{value:t.email},on:{input:function(e){e.target.composing||(t.email=e.target.value)}}}),t._v(" "),s("span",{staticClass:"register__wrapper__vo__form__vp__error uk-text-danger"},[t._v(t._s(a[0]))])]}}],null,!0)}),t._v(" "),s("ValidationProvider",{staticClass:"register__wrapper__vo__form__vp",attrs:{rules:"required"},scopedSlots:t._u([{key:"default",fn:function(e){var a=e.errors;return[s("label",{staticClass:"register__wrapper__vo__form__vp__label",attrs:{for:"form-stacked-text"}},[t._v("Genero")]),t._v(" "),s("select",{directives:[{name:"model",rawName:"v-model",value:t.gender,expression:"gender"}],staticClass:"register__wrapper__vo__form__vp__input uk-select",attrs:{name:"gender"},on:{change:function(e){var s=Array.prototype.filter.call(e.target.options,function(t){return t.selected}).map(function(t){return"_value"in t?t._value:t.value});t.gender=e.target.multiple?s:s[0]}}},t._l(t.genders,function(e,a){return s("option",{key:a,domProps:{value:e.id}},[t._v(t._s(e.gender))])}),0),t._v(" "),s("span",{staticClass:"register__wrapper__vo__form__vp__error uk-text-danger"},[t._v(t._s(a[0]))])]}}],null,!0)}),t._v(" "),s("ValidationProvider",{staticClass:"register__wrapper__vo__form__vp",attrs:{rules:"required"},scopedSlots:t._u([{key:"default",fn:function(e){var a=e.errors;return[s("label",{staticClass:"register__wrapper__vo__form__vp__label",attrs:{for:"form-stacked-text"}},[t._v("Estado civil")]),t._v(" "),s("select",{directives:[{name:"model",rawName:"v-model",value:t.marital,expression:"marital"}],staticClass:"register__wrapper__vo__form__vp__input uk-select",attrs:{name:"marital"},on:{change:function(e){var s=Array.prototype.filter.call(e.target.options,function(t){return t.selected}).map(function(t){return"_value"in t?t._value:t.value});t.marital=e.target.multiple?s:s[0]}}},t._l(t.ms,function(e,a){return s("option",{key:a,domProps:{value:e.id}},[t._v(t._s(e.status))])}),0),t._v(" "),s("span",{staticClass:"register__wrapper__vo__form__vp__error uk-text-danger"},[t._v(t._s(a[0]))])]}}],null,!0)}),t._v(" "),s("ValidationProvider",{staticClass:"register__wrapper__vo__form__vp",attrs:{rules:"required"},scopedSlots:t._u([{key:"default",fn:function(e){var a=e.errors;return[s("label",{staticClass:"register__wrapper__vo__form__vp__label",attrs:{for:"form-stacked-text"}},[t._v("Fecha de nacimiento")]),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.birthday,expression:"birthday"}],staticClass:"register__wrapper__vo__form__vp__input",attrs:{type:"date"},domProps:{value:t.birthday},on:{input:function(e){e.target.composing||(t.birthday=e.target.value)}}}),t._v(" "),s("span",{staticClass:"register__wrapper__vo__form__vp__error uk-text-danger"},[t._v(t._s(a[0]))])]}}],null,!0)}),t._v(" "),s("ValidationProvider",{staticClass:"register__wrapper__vo__form__vp",attrs:{name:"job",rules:"required"},scopedSlots:t._u([{key:"default",fn:function(e){var a=e.errors;return[s("label",{staticClass:"register__wrapper__vo__form__vp__label",attrs:{for:"form-stacked-text"}},[t._v("Ocupacion")]),t._v(" "),s("select",{directives:[{name:"model",rawName:"v-model",value:t.job,expression:"job"}],staticClass:"register__wrapper__vo__form__vp__input uk-select",on:{change:function(e){var s=Array.prototype.filter.call(e.target.options,function(t){return t.selected}).map(function(t){return"_value"in t?t._value:t.value});t.job=e.target.multiple?s:s[0]}}},t._l(t.jobs,function(e,a){return s("option",{key:a,domProps:{value:e.id}},[t._v(t._s(e.name))])}),0),t._v(" "),s("span",{staticClass:"register__wrapper__vo__form__vp__error uk-text-danger"},[t._v(t._s(a[0]))])]}}],null,!0)}),t._v(" "),t.loading?t._e():s("button",{staticClass:"uk-button uk-button-primary",attrs:{type:"submit"}},[s("span",[t._v("Registrarte")])]),t._v(" "),t.loading?s("div",{staticClass:"uk-button uk-button-primary"},[s("div",{staticClass:"loadingContainer"},[s("div",{staticClass:"loader"},[t._v("Loading...")])]),t._v(" "),s("span",[t._v("Registrando")])]):t._e()],1),t._v(" "),s("a",{attrs:{href:"#","uk-totop":"","uk-scroll":""}})]}}])})],1)])},staticRenderFns:[]};var E={name:"Survey",data:function(){return{welcome:"Bienvenido"}},created:function(){this.$route.params.page;this.$store.commit("setCanGout",!1)},mounted:function(){},beforeRouteLeave:function(t,e,s){var a=this.$store.getters.getSectionData.sectionStatus,n=function(t){return null!=t.answer},o=a.every(n);n=function(t){return null==t.answer};var r=a.every(n);console.log("Todas las preguntas contestadas: "+o),console.log("Todas las preguntas sin contestar: "+r);var i=this.$store.getters.getCanGout;console.log("Podemos salir: "+i),i||(o||r)&&r?s():Swal.fire({title:"¿Estas seguro?",text:"Las preguntas contestadas no seran guardadas",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Entendido"}).then(function(t){t.value?s():s(!1)})}},I={render:function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"survey"},[e("router-view",{staticClass:"survey__view"})],1)},staticRenderFns:[]};var N={render:function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"qdashboard"},[s("div",{staticClass:"qdashboard__wrapper"},[s("div",{staticClass:"qdashboard__wrapper__title-container"},[s("ul",{staticClass:"uk-breadcrumb"},[s("li",{staticClass:"home",on:{click:t.home}},[t._v("Inicio")]),t._v(" "),s("li",[t._v("Sección "+t._s(t.section))])])]),t._v(" "),s("div",{staticClass:"qdashboard__wrapper__questions-container"},t._l(t.questions,function(e,a){return s("div",{key:a,staticClass:"qdashboard__wrapper__questions-container__item-container"},[0==e.answered?s("div",{staticClass:"qdashboard__wrapper__questions-container__item-container__item",class:{green:null!=e.answer,blue:null==e.answer},on:{click:function(s){return t.prueba(e.question)}}},[s("p",{staticClass:"qdashboard__wrapper__questions-container__item-container__item__text"},[t._v(t._s(e.question))])]):s("div",{staticClass:"qdashboard__wrapper__questions-container__item-container__item",class:{active:1!=e.answered}},[s("p",{staticClass:"qdashboard__wrapper__questions-container__item-container__item__text"},[t._v(t._s(e.question))])])])}),0)])])},staticRenderFns:[]};var j={name:"Question",created:function(){this.$store.commit("setDisabled",!0),this.loading=!1},data:function(){return{welcome:"Bienvenido",loading:!1}},computed:{actualQuestion:function(){return this.$route.params.question},lastQuestion:function(){var t=this.$store.getters.getSectionData.questions.data.length;return this.$store.getters.getSectionData.questions.data[t-1]},question:function(){var t=this;return this.$store.getters.getSectionData.questions.data.find(function(e){return e.id==t.actualQuestion})},questionsLength:function(){return this.$store.getters.getQuestions.length},checkLastSection:function(){return this.$store.getters.getCheckFinalSection},lastSection:function(){var t=this.$store.getters.getSections;return t.reduce(function(t,e){return t+e})==t.length-1}},methods:{nextQuestion:function(){var t=parseInt(this.$route.params.id);if(!(t+1>this.questionsLength))return t+=1,this.$router.push({name:"surveyQuestion",params:{id:t}}),!0;this.$store.commit("setShowSectionCompleted",{status:!0,section:this.$store.getters.getPaginate}),this.$router.push({name:"home"})},answer:function(t){var e=this,s=this.$route.params.page,a=this.$route.params.question;console.log("Last question: "+this.lastQuestion.id),console.log("Actual page: "+s),s<=this.lastQuestion.id&&this.$store.commit("setAnswerOfQuestion",{page:s,question:a,answer:t});this.$store.getters.getSectionData.sectionStatus.every(function(t){return null!=t.answer})?(console.log("Todas las preguntas estan contestadas"),Swal.fire({title:"Has contestado todas las preguntas",text:"¿Desea guardar sus repuestas?;",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Si, desea guardarlos"}).then(function(t){t.value&&(e.$store.commit("setCanGout",!0),e.loading=!0,e.$store.dispatch("saveAnswersInServer",{page:s,lastSection:e.lastSection}).then(function(t){e.$store.commit("setNewSectionsStatus",s),e.$store.commit("setShowMessageSectionCompleted",{status:!0,section:s}),e.$router.push({name:"home"})}).catch(function(t){console.log(),e.loading=!1,401==t.status&&Swal.fire("El administrador desactivo las encuestas","Para mas informacion favor de contactarse con el administrador","error")}))})):this.actualQuestion<this.lastQuestion.id?this.$router.push({name:"question",params:{question:this.actualQuestion+1}}):(console.log("Ya estas en la ultima pregunta, no se avanzara mas"),this.$router.push({name:"dashboard"}))},evaluate:function(t){},goBack:function(){this.$router.go(-1)},leaving:function(){this.$router.push({name:"home"})},goToDashboard:function(){this.$router.push({name:"dashboard"})}},watch:{$route:function(t,e){this.$store.commit("setDisabled",!0)}}},P={render:function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"question"},[s("div",{staticClass:"question__wrapper"},[s("section",{staticClass:"question__wrapper__header"},[s("div",{staticClass:"question__wrapper__header__nav",on:{click:t.goBack}},[s("span",{attrs:{"uk-icon":"icon: chevron-left"}}),t._v(" "),s("p",[t._v("Atras")])]),t._v(" "),s("div",{staticClass:"question__wrapper__header__list"},[s("span",{attrs:{"uk-icon":"icon: grid; ratio: 1.3"},on:{click:t.goToDashboard}})]),t._v(" "),s("div",{staticClass:"question__wrapper__header__pages"},[s("p",[t._v(t._s(t.actualQuestion)+"/"+t._s(t.lastQuestion.id))])])]),t._v(" "),s("section",{staticClass:"question__wrapper__body"},[s("div",{staticClass:"question__wrapper__body__question-container"},[s("h2",{staticClass:"question__wrapper__body__question-container__question"},[t._v(t._s(t.question.id)+". "+t._s(t.question.question))])]),t._v(" "),s("div",{staticClass:"question__wrapper__body__answers-container"},[s("div",{staticClass:"question__wrapper__body__answers-container__button question__wrapper__body__answers-container__button--true",class:{loadingButton:t.loading},on:{click:function(e){return t.answer(!0)}}},[s("p",[t._v("Verdadero")])]),t._v(" "),s("div",{staticClass:"question__wrapper__body__answers-container__button question__wrapper__body__answers-container__button--false",class:{loadingButton:t.loading},on:{click:function(e){return t.answer(!1)}}},[s("p",[t._v("Falso")])]),t._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:t.loading,expression:"loading"}],staticClass:"question__wrapper__body__answers-container__overlay"})])]),t._v(" "),t.loading?s("div",{staticClass:"question__loading"},[s("div",{attrs:{"uk-spinner":"ratio: 3"}})]):t._e()])])},staticRenderFns:[]};var R={name:"Finished",data:function(){return{msg:"Welcome to Your Vue.js App"}},created:function(){this.$store.commit("setFinished")},methods:{getFilter:function(){console.log(this.$store.getters.getFilter)},logout:function(){this.$router.push({name:"logout"})}}},F={render:function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"finished"},[e("div",{staticClass:"finished__wrapper"},[this._m(0),this._v(" "),e("div",{staticClass:"finished__wrapper__button"},[e("button",{staticClass:"uk-button uk-button-danger",on:{click:this.logout}},[this._v("Cerrar sesion")])])])])},staticRenderFns:[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"finished__wrapper__title"},[e("h2",[this._v("Encuesta finalizada")])])}]};var T=[{path:"/",redirect:{name:"home"}},{path:"/home",name:"home",component:p,meta:{requiresAuth:!0}},{path:"/login",name:"login",component:f,meta:{requiresVisitor:!0}},{path:"/logout",name:"logout",component:w,meta:{requiresAuth:!0}},{path:"/registro",name:"register",component:s("VU/8")(D,x,!1,function(t){s("zG2G")},null,null).exports,meta:{requiresVisitor:!0}},{path:"/cuestionario/:page",name:"survey",component:s("VU/8")(E,I,!1,function(t){s("8eHi")},null,null).exports,meta:{requiresData:!0},children:[{path:"dashboard",component:s("VU/8")({name:"QuestionsDashboard",created:function(){},data:function(){return{welcome:"Bienvenido"}},computed:{getQuestions:function(){return this.$store.getters.getQuestions},section:function(){return this.$store.getters.getSectionData.questions.current_page},questions:function(){return this.$store.getters.getSectionData.sectionStatus}},methods:{prueba:function(t){this.$router.push({name:"question",params:{question:t}})},home:function(){this.$router.push({name:"home"})}}},N,!1,function(t){s("Hsze")},"data-v-4a514f72",null).exports,name:"dashboard"},{path:":question",component:s("VU/8")(j,P,!1,function(t){s("r8zy")},"data-v-578ef50e",null).exports,name:"question"}]},{path:"/finalizado",name:"finished",component:s("VU/8")(R,F,!1,function(t){s("duby")},"data-v-324e6d3e",null).exports,meta:{}}],A=s("//Fk"),V=s.n(A),M=s("mvHQ"),B=s.n(M),G=s("NYxO"),O=s("mtWM"),L=s.n(O);i.a.use(G.a),L.a.defaults.baseURL="http://orion.com:4200/api";var Q=new G.a.Store({state:{code:sessionStorage.getItem("access_code")||null,sections:null,loading:!1,disabled:!1,personal:[{id:2,name:"Prueba",apaterno:"Prueba",amaterno:"Prueba",gender:2,marital_status:6,birthday:"1972-10-11",job:2,email:null,survey_available:"eyJpdiI6IklyMnk2YUw3djJuRkJiRlNJS3hDa2c9PSIsInZhbHVlIjoiUGlNcVAxbGlUN0h4OVpRa3BJcmVGZz09IiwibWFjIjoiZDMzNDRjOWE0N2RhYmYwZWFlYTg4ZDZmZTljNTllMjhmMzEyYmNmNTBiMjA2N2E1NzA2NDE5MmQ3YTljMmYwYSJ9",completed_surveys:"eyJpdiI6IkFTZm5yZmlDSExzZkY2YmR3ZGxIS3c9PSIsInZhbHVlIjoiWWU5WG5GSFVMSGNaUnhyVnZFa2k3Zz09IiwibWFjIjoiM2M3ODQ0ZTMzNDk1NTUyYTgwN2I2ZGU2YzBmMmY2MjE0M2EzYTZlNWE1ZjY3NzlmMjRlOTI1MjU4ZDYwZGY2ZCJ9"}],showMessageSectionCompleted:{status:!1,section:null},sectionsData:[],sectionData:null,homeAlreadyFirstLoaded:!1,canGout:!1},getters:{getSections:function(t){return t.sections},getLoading:function(t){return t.loading},getDisabled:function(t){return t.disabled},getShowMessageSectionCompleted:function(t){return t.showMessageSectionCompleted},getPersonal:function(t){return t.personal},getPersonalObj:function(t){return t.personal[0]},getSectionsData:function(t){return t.sectionsData},getSectionData:function(t){return t.sectionData},getHomeAlreadyFirstLoaded:function(t){return t.homeAlreadyFirstLoaded},getCode:function(t){return t.code},getCanGout:function(t){return t.canGout}},mutations:{setSections:function(t,e){t.sections=e},setLoading:function(t,e){t.loading=e},setDisabled:function(t,e){t.disabled=e},setShowMessageSectionCompleted:function(t,e){t.showMessageSectionCompleted.status=e.status,t.showMessageSectionCompleted.section=e.section},logout:function(t){t.sections=null,t.homeAlreadyFirstLoaded=!1,t.paginate=null,t.questions=null,t.loading=!1,t.disabled=!1,t.personal=[],t.showMessageSectionCompleted={status:!1,section:null}},setPersonal:function(t,e){t.personal=e},setSectionsData:function(t,e){t.sectionsData.push(e)},setSectionData:function(t,e){t.sectionData=JSON.parse(B()(e))},setAnswerOfQuestion:function(t,e){var s=t.sectionData.sectionStatus;s[s.findIndex(function(t){return t.question==e.question})].answer=e.answer},setNewSectionsStatus:function(t,e){var s=e-1;t.sections[s]=1},setHomeAlreadyFirstLoaded:function(t,e){t.homeAlreadyFirstLoaded=e},setCode:function(t,e){t.code=e},setFinished:function(t){t.sections=null,t.homeAlreadyFirstLoaded=!1},setCanGout:function(t,e){t.canGout=e}},actions:{getSections:function(t){var e=this.getters.getCode;return new V.a(function(t,s){L.a.get("/getsections",{params:{code:e}}).then(function(e){console.log(e.data),t(e.data)}).catch(function(t){s(t)})})},getSectionData:function(t,e){var s=this.getters.getCode;return new V.a(function(t,a){L.a.get("/getsectiondata",{params:{page:e,code:s}}).then(function(e){t(e.data)}).catch(function(t){a(t.response)}).then(function(){})})},saveAnswersInServer:function(t,e){var s=this.getters.getCode,a=t.getters.getSectionData.sectionStatus.filter(function(t){return 0==t.answered});return new V.a(function(t,n){L.a.post("/saveanswers",{data:a,lastSection:e.lastSection,code:s}).then(function(e){console.log(e.data),t(e.data)}).catch(function(t){n(t.response)})})},login:function(t,e){return new V.a(function(t,s){L.a.post("/login",{code:e}).then(function(e){t(e.data)}).catch(function(t){console.log(t),s(t)})})},getRegisterData:function(t){return new V.a(function(t,e){L.a.get("/register").then(function(e){t(e.data)}).catch(function(t){e(t)}).then(function(){})})},storeUser:function(t,e){return new V.a(function(t,s){L.a.post("/register",e).then(function(e){t(e.data)}).catch(function(t){s(t.response)})})}}}),U=s("e7x4"),Z=s.n(U);console.log("Version 4"),window.UIkit=r.a,r.a.use(n.a),window.Swal=Z.a,i.a.config.productionTip=!1,i.a.use(c.a);var z=new c.a({routes:T,mode:"history"});z.beforeEach(function(t,e,s){t.matched.some(function(t){return t.meta.requiresAuth})?null==Q.getters.getCode?s({name:"login"}):s():t.matched.some(function(t){return t.meta.requiresData})?null==Q.getters.getSections?s({name:"home"}):s():t.matched.some(function(t){return t.meta.requiresVisitor})&&null!=Q.getters.getCode?s({name:"home"}):s()}),new i.a({el:"#app",router:z,store:Q,components:{App:_},template:"<App/>"})},"XR+H":function(t,e){},duby:function(t,e){},"nzR+":function(t,e){},r8zy:function(t,e){},zG2G:function(t,e){}},["NHnr"]);
//# sourceMappingURL=app.5e833f51f4c389795d5e.js.map