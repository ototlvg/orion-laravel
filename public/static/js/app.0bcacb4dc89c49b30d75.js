webpackJsonp([1],{"/B5k":function(t,e){},"3dN6":function(t,e){},DNko:function(t,e){},NHnr:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});n("3dN6");var s=n("/zV6"),i=n.n(s),o=n("2EC8"),a=n.n(o),r=n("7+uW"),c=n("/ocq"),u={name:"App",components:{},created:function(){this.setDisabled()},data:function(){return{}},computed:{isDisabled:function(){return this.$store.getters.getDisabled}},methods:{toggle:function(){UIkit.offcanvas(document.getElementById("my-id")).show()},setDisabled:function(){this.$store.commit("setDisabled",!1)}},watch:{$route:function(t,e){this.setDisabled()}}},l={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{attrs:{id:"app"}},[n("nav",{staticClass:"uk-navbar-container uk-navbar",class:{disabled:t.isDisabled},attrs:{"uk-navbar":""}},[n("div",{staticClass:"uk-navbar-orion-mobil"},[n("span",{staticClass:"uk-margin-small-right uk-navbar-orion-mobil__burguer",attrs:{"uk-icon":"icon: menu; ratio: 2"},on:{click:t.toggle}}),t._v(" "),n("h1",{staticClass:"uk-navbar-orion-mobil__title"},[t._v("Orion")])]),t._v(" "),t._m(0),t._v(" "),n("div",{staticClass:"uk-navbar-right uk-navbar-right-orion"},[n("ul",{staticClass:"uk-navbar-nav"},[n("li",{staticClass:"uk"},[n("router-link",{attrs:{to:{name:"home"}}},[t._v("INICIO")])],1),t._v(" "),n("li",{staticClass:"uk"},[n("router-link",{attrs:{to:{name:"login"}}},[t._v("INICIAR SESION")])],1),t._v(" "),n("li",{staticClass:"uk"},[n("router-link",{attrs:{to:{name:"register"}}},[t._v("REGISTRARSE")])],1),t._v(" "),n("li",{staticClass:"uk"},[n("router-link",{attrs:{to:{name:"logout"}}},[t._v("Cerrar sesion")])],1),t._v(" "),t._m(1)])])]),t._v(" "),n("a",{attrs:{href:"#my-id","uk-toggle":""}}),t._v(" "),t._m(2),t._v(" "),n("main",{staticClass:"main"},[n("router-view")],1)])},staticRenderFns:[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"uk-navbar-left uk-navbar-left-orion"},[e("a",{staticClass:"uk-navbar-item uk-logo",attrs:{href:""}},[this._v("Orion")])])},function(){var t=this.$createElement,e=this._self._c||t;return e("li",[e("a",{attrs:{href:""}})])},function(){var t=this.$createElement,e=this._self._c||t;return e("div",{attrs:{id:"my-id","uk-offcanvas":"mode: push; overlay: true"}},[e("div",{staticClass:"uk-offcanvas-bar"},[e("button",{staticClass:"uk-offcanvas-close",attrs:{type:"button","uk-close":""}})])])}]};var d=n("VU/8")(u,l,!1,function(t){n("DNko")},null,null).exports,_={name:"Home",created:function(){var t=this;this.$store.dispatch("getSections").then(function(e){t.$store.commit("setSections",e)}),this.$store.getters.showSectionCompleted.status&&this.showSectionCompleted()},data:function(){return{welcome:"Bienvenido"}},computed:{sections:function(){return this.$store.getters.getSections},questions:function(){return this.$store.getters.getQuestions}},methods:{goToSection:function(t){var e=this,n=t+1;this.$store.dispatch("getQuestionsOfSection",n).then(function(t){e.$store.commit("setPaginate",n),e.$store.commit("setQuestions",t.data),e.questions[0].answer?e.$router.push({name:"questionsDashboard"}):e.$router.push({name:"surveyQuestion",params:{id:"1"}})})},evaluate:function(t){var e=this;1==this.$store.getters.getSections[t]?Swal.fire({title:"¿Esta seguro?",text:"Ya terminaste de contestar esta encuesta",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Si, deseo contestarla de nuevo",cancelButtonText:"Cancelar"}).then(function(n){n.value&&e.goToSection(t)}):this.goToSection(t)},prueba:function(){Swal.fire({title:"Error!",text:"Do you want to continue",icon:"error",confirmButtonText:"Cool"})},showSectionCompleted:function(){var t=this;Swal.fire({position:"top-end",icon:"success",title:"Seccion "+t.$store.getters.showSectionCompleted.section+" contestada",showConfirmButton:!1,timer:1500}).then(function(e){t.$store.commit("setShowSectionCompleted",{status:!1,section:null})})}}},m={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"home"},[n("div",{staticClass:"wrapper"},t._l(t.sections,function(e,s){return n("div",{key:s,staticClass:"section",class:{green:e,warning:!e},on:{click:function(e){return t.evaluate(s)}}},[n("div",{staticClass:"section__data"},[n("h2",{staticClass:"section__data__title"},[t._v("Seccion "+t._s(s+1))]),t._v(" "),n("h3",{staticClass:"section__data__status"},e?[t._v("Contestado")]:[t._v("Pendiente")])]),t._v(" "),n("div",{staticClass:"section__image"},[n("div",{staticClass:"section__image__circle",class:{green:e,warning:!e}},[n("span",e?{staticClass:"uk-icon-link",attrs:{"uk-icon":"icon: check; ratio: 2"}}:{staticClass:"uk-icon-link clock",attrs:{"uk-icon":"icon: clock; ratio: 2"}})])])])}),0)])},staticRenderFns:[]};var h=n("VU/8")(_,m,!1,function(t){n("RwmF")},"data-v-75edda8e",null).exports,f={render:function(){this.$createElement;this._self._c;return this._m(0)},staticRenderFns:[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"login"},[e("div",{staticClass:"aksldj"},[this._v("Aqui va el Login")])])}]};var v=n("VU/8")({name:"Login",data:function(){return{welcome:"Bienvenido"}}},f,!1,function(t){n("j5QE")},null,null).exports,p={render:function(){this.$createElement;this._self._c;return this._m(0)},staticRenderFns:[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"logout"},[e("div",{staticClass:"aksldj"},[this._v("Aqui va el logout")])])}]};var g=n("VU/8")({name:"Logout",data:function(){return{welcome:"Bienvenido"}}},p,!1,function(t){n("ipxR")},null,null).exports,w={render:function(){this.$createElement;this._self._c;return this._m(0)},staticRenderFns:[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"register"},[e("div",{staticClass:"aksldj"},[this._v("Aqui va el registerss")])])}]};var C=n("VU/8")({name:"Register",data:function(){return{welcome:"Bienvenido"}}},w,!1,function(t){n("Uzps")},null,null).exports,k={render:function(){this.$createElement;this._self._c;return this._m(0)},staticRenderFns:[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"survey"},[e("div",{staticClass:"aksldj"},[this._v("Survey")])])}]};n("VU/8")({name:"Survey",data:function(){return{welcome:"Bienvenido"}}},k,!1,function(t){n("/B5k")},null,null).exports;var b={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"qdashboard"},[n("div",{staticClass:"qdashboard__wrapper"},[n("div",{staticClass:"qdashboard__wrapper__questions-container"},t._l(t.getQuestions,function(e,s){return n("div",{key:s,staticClass:"qdashboard__wrapper__questions-container__item-container"},[n("div",{staticClass:"qdashboard__wrapper__questions-container__item-container__item",class:{active:null==e.answer},on:{click:function(e){return t.prueba(s+1)}}},[n("p",{staticClass:"qdashboard__wrapper__questions-container__item-container__item__text"},[t._v(t._s(s+1))])])])}),0)])])},staticRenderFns:[]};var $={name:"Question",created:function(){this.$store.commit("setDisabled",!0)},data:function(){return{welcome:"Bienvenido"}},computed:{idRoute:function(){return this.$route.params.id},question:function(){return this.$store.getters.getQuestions[this.$route.params.id-1]},questionsLength:function(){return this.$store.getters.getQuestions.length},loading:function(){return this.$store.getters.getLoading}},methods:{nextQuestion:function(){var t=parseInt(this.$route.params.id);if(!(t+1>this.questionsLength))return t+=1,this.$router.push({name:"surveyQuestion",params:{id:t}}),!0;this.$store.commit("setShowSectionCompleted",{status:!0,section:this.$store.getters.getPaginate}),this.$router.push({name:"home"})},answer:function(t){var e=this;this.$store.commit("setLoading",!0),this.$store.dispatch("saveAnswer",{id:this.question.question,answer:t}).then(function(t){e.$store.commit("setNewAnswer",{index:e.$route.params.id-1,answer:t.answer?1:0}),e.nextQuestion(),e.$store.commit("setLoading",!1)}).catch(function(t){console.log(t)})},evaluate:function(t){},goBack:function(){this.$router.go(-1)}},watch:{$route:function(t,e){this.$store.commit("setDisabled",!0)}}},q={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"question"},[n("div",{staticClass:"question__wrapper"},[n("section",{staticClass:"question__wrapper__header"},[n("div",{staticClass:"question__wrapper__header__nav",on:{click:t.goBack}},[n("span",{attrs:{"uk-icon":"icon: chevron-left"}}),t._v(" "),n("p",[t._v("Back")])]),t._v(" "),n("div",{staticClass:"question__wrapper__header__pages"},[n("p",[t._v(t._s(t.idRoute)+"/"+t._s(t.questionsLength))])])]),t._v(" "),n("section",{staticClass:"question__wrapper__body"},[n("div",{staticClass:"question__wrapper__body__question-container"},[n("h2",{staticClass:"question__wrapper__body__question-container__question"},[t._v(t._s(t.question.question.question))])]),t._v(" "),n("div",{staticClass:"question__wrapper__body__answers-container"},[n("div",{staticClass:"question__wrapper__body__answers-container__button question__wrapper__body__answers-container__button--true",on:{click:function(e){return t.answer(!0)}}},[n("p",[t._v("Verdadero")])]),t._v(" "),n("div",{staticClass:"question__wrapper__body__answers-container__button question__wrapper__body__answers-container__button--false",on:{click:function(e){return t.answer(!1)}}},[n("p",[t._v("Falso")])])])])])])},staticRenderFns:[]};var S=[{path:"/home",name:"home",component:h},{path:"/login",name:"login",component:v},{path:"/logout",name:"logout",component:g},{path:"/registro",name:"register",component:C},{path:"/cuestionario",name:"questionsDashboard",component:n("VU/8")({name:"QuestionsDashboard",created:function(){this.$store.getters.getPaginate||this.$router.push({name:"home"})},data:function(){return{welcome:"Bienvenido"}},computed:{getQuestions:function(){return this.$store.getters.getQuestions}},methods:{prueba:function(t){this.$router.push({name:"surveyQuestion",params:{id:t}})}}},b,!1,function(t){n("XTll")},"data-v-58903a46",null).exports},{path:"/cuestionario/:id",name:"surveyQuestion",component:n("VU/8")($,q,!1,function(t){n("zrC7")},"data-v-7986ee99",null).exports}],y=n("//Fk"),D=n.n(y),I=n("NYxO"),x=n("mtWM"),E=n.n(x);r.a.use(I.a),E.a.defaults.baseURL="http://orion.com/api";var R=new I.a.Store({state:{token:localStorage.getItem("access_token")||null,patientCode:"a34a12588d6ca16e9766a9618daff229f484ef84",patiendID:"eyJpdiI6IlBpdVo3bUpZS1p6RXQyNFRka2gzTmc9PSIsInZhbHVlIjoicEpRYkFRczlKeG9vRFVvMzZMZkc1Zz09IiwibWFjIjoiMDc5MjllMzUyZmM3ZmYxNDg3NzFiODZiMjgxN2Q4Y2MwNjkzMWUwMDdjZTY3NGYxMTJlZmQ5NmFmZThiMjc3MCJ9",sections:null,paginate:null,questions:null,loading:!1,disabled:!1,personal:{name:"Jason",apaterno:"Torres",amaterno:"Luis"},showSectionCompleted:{status:!1,section:null}},getters:{getSections:function(t){return t.sections},getPatiendID:function(t){return t.patiendID},getQuestions:function(t){return t.questions},getPaginate:function(t){return t.paginate},getLoading:function(t){return t.loading},getDisabled:function(t){return t.disabled},showSectionCompleted:function(t){return t.showSectionCompleted}},mutations:{setSections:function(t,e){t.sections=e},setQuestions:function(t,e){t.questions=e},setPaginate:function(t,e){t.paginate=e},setNewAnswer:function(t,e){t.questions[e.index].answer=e.answer},setLoading:function(t,e){t.loading=e},setDisabled:function(t,e){t.disabled=e},setShowSectionCompleted:function(t,e){t.showSectionCompleted.status=e.status,t.showSectionCompleted.section=e.section}},actions:{getQuestionsOfSection:function(t,e){return new D.a(function(n,s){E.a.get("/getquestions",{params:{id:t.getters.getPatiendID,page:e}}).then(function(t){n(t.data)}).catch(function(t){console.log(t)}).then(function(){})})},getSections:function(t){return new D.a(function(e,n){E.a.get("/getsections",{params:{patient_id:t.getters.getPatiendID}}).then(function(t){e(t.data)}).catch(function(t){n(t)})})},saveAnswer:function(t,e){return new D.a(function(n,s){E.a.post("/saveanswer",{id:e.id,answer:e.answer,patient:t.getters.getPatiendID}).then(function(t){n(t.data)}).catch(function(t){console.log(t),s(t)})})},getPersonalInfo:function(){}}}),Q=n("e7x4"),B=n.n(Q);window.UIkit=a.a,a.a.use(i.a),window.Swal=B.a,r.a.config.productionTip=!1,r.a.use(c.a);var N=new c.a({routes:S,mode:"history"});new r.a({el:"#app",router:N,store:R,components:{App:d},template:"<App/>"})},RwmF:function(t,e){},Uzps:function(t,e){},XTll:function(t,e){},ipxR:function(t,e){},j5QE:function(t,e){},zrC7:function(t,e){}},["NHnr"]);
//# sourceMappingURL=app.0bcacb4dc89c49b30d75.js.map