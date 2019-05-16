"use strict";

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/*!
 * zaneDate Javascript Library 1.1.0
 * https://github.com/wangweianger/zane-data-time-calendar
 * Date : 2017-09-22
 * auther :zane
 */
;(function (global, factory) {
	"use strict";

	if ((typeof module === "undefined" ? "undefined" : _typeof(module)) === "object" && _typeof(module.exports) === "object") {
		module.exports = global.document ? factory(global, true) : function (w) {
			if (!w.document) {
				throw new Error("zaneDate requires a window with a document");
			}
			return factory(w);
		};
	} else {
		factory(global);
	}
})(typeof window !== "undefined" ? window : undefined, function (window, noGlobal) {

	if (noGlobal) require('./zane-calendar.min.css');

	if (!new Date().Format) {
		Date.prototype.Format = function (fmt) {
			//author: meizz 
			var o = {
				"M+": this.getMonth() + 1, //月份 
				"d+": this.getDate(), //日 
				"h+": this.getHours() > 12 ? this.getHours() - 12 : this.getHours(), //小时 
				"H+": this.getHours(),
				"m+": this.getMinutes(), //分 
				"s+": this.getSeconds(), //秒 
				"q+": Math.floor((this.getMonth() + 3) / 3), //季度 
				"S": this.getMilliseconds() //毫秒 
			};
			if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
			for (var k in o) {
				if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k] : ("00" + o[k]).substr(("" + o[k]).length));
			}return fmt;
		};
	};

	var doc = document,
	    query = 'querySelector',
	    quall = 'querySelectorAll';

	// 日期插件

	var calendar = function () {
		function calendar() {
			var json = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

			_classCallCheck(this, calendar);

			this.config = {
				//控件的dom原生仅限制于id
				elem: '#zane-calendar-2',
				//可选 day year month time doubleday doubleyear doublemonth doubletime
				type: 'day',
				//absolute , fixed   
				position: 'fixed',
				//cn , en 
				lang: 'cn',
				// 宽度
				width: 250,
				// 插件高度配置
				height: 280,
				//插件于输入框的高度 
				behindTop: 10,
				// 格式化
				format: 'yyyy-MM-dd', //'yyyy-MM-dd HH:mm:ss'
				// 初始默认值
				value: '',
				// 可选取时间最小范围
				min: '', //'1900-10-01',
				// 可选取时间最大范围
				max: '', //'2099-12-31',
				//事件方式 click 
				event: 'click',
				// z-index的值
				zindex: 100,
				//是否显示选择时间
				showtime: false,
				//是否显示清除按钮
				showclean: true,
				//是否显示当前按钮
				shownow: true,
				//是否显示提交按钮
				showsubmit: true,
				// 是否有底部按钮列表
				haveBotBtns: true,
				// type='time'时是否显示秒单位
				showsecond: true,

				calendarName: '',
				isDouble: false,
				// 插件加载完成之后调用
				mounted: function mounted() {},
				//时间变更之后调用
				change: function change() {},
				//选择完成之后调用
				done: function done() {}
			};
			this.config = this.extend(this.config, json);
			//校验时间格式
			if (!this.config.value) this.config.value = '';
			if (!this.config.min) this.config.min = '';
			if (!this.config.max) this.config.max = '';

			// 初始化
			this.init();
		}

		// 生成对象obj


		_createClass(calendar, [{
			key: "generateCalendarObj",
			value: function generateCalendarObj() {
				this.obj = {
					input: doc[query](this.config.elem),
					calendar: null,
					id: "#zane-calendar-2-" + this.config.calendarName,
					$obj: null,
					fulldatas: {},
					$noDoubleObj: null,
					isDoubleOne: false,
					handleType: 'date',
					initVal: '', //每次进来的初始值
					// 选择年时展示的数量
					totalYear: 18,
					cn: {
						weeks: ['日', '一', '二', '三', '四', '五', '六'],
						time: ['时', '分', '秒'],
						timeTips: '选择时间',
						startTime: '开始时间',
						endTime: '结束时间',
						dateTips: '返回日期',
						month: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
						tools: {
							confirm: '确定',
							clear: '清空',
							now: '现在'
						}
					},
					en: {
						weeks: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
						time: ['Hours', 'Minutes', 'Seconds'],
						timeTips: 'Select Time',
						startTime: 'Start Time',
						endTime: 'End Time',
						dateTips: 'Select Date',
						month: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
						tools: {
							confirm: 'Confirm',
							clear: 'Clear',
							now: 'Now'
						}
					}
				};

				this.vision = '2.0.9';
				this.auther = 'zane';

				this.obj.lang = this.obj[this.config.lang];

				if (this.config.type == 'year' || this.config.type == 'month') {
					this.config.haveBotBtns = false;
				}

				if (this.config.type == 'time') {
					this.config.showtime = false;
				}

				// double 处理
				if (this.config.isDouble) {
					this.obj.input.nodeName !== 'INPUT' ? this.obj.input.textContent = this.config.doublevalue : this.obj.input.value = this.config.doublevalue;
				} else if (!this.config.isDouble) {
					this.obj.input.nodeName !== 'INPUT' ? this.obj.input.textContent = this.config.value : this.obj.input.value = this.config.value;
				}
			}
		}, {
			key: "init",
			value: function init() {
				var _this2 = this;

				this.generateCalendarObj();
				this.on(this.obj.input, this.config.event, function (e) {
					e.preventDefault();
					e.stopPropagation();

					// 隐藏其他时间插件框
					var objs = doc[quall]('.zane-calendar');
					_this2.forEach(objs, function (index, item) {
						var itemId = item.getAttribute('id');
						if (('#' + itemId).replace(/DOUBLE/, '') !== _this2.obj.id.replace(/DOUBLE/, '')) {
							itemId = itemId.replace('zane-calendar-', '');
							_this2.removeCalendar();
						}
					});

					var obj = doc[query](_this2.obj.id);

					if (obj) {
						_this2.obj.calendar = obj;
						_this2.$obj = obj;
					};

					// double 赋值
					_this2.obj.isDoubleOne = _this2.config.calendarName.indexOf('DOUBLE') != -1 ? true : false;
					if (_this2.obj.isDoubleOne) {
						var noDoubleObj = _this2.config.calendarName.replace(/DOUBLE/, '');
						_this2.obj.$noDoubleObj = window[noDoubleObj];
						window[noDoubleObj].obj.$noDoubleObj = _this2;
					};

					// 设置默认值
					var defaultValue = void 0,
					    inpValue = void 0;
					defaultValue = _this2.obj.input.nodeName === 'INPUT' ? _this2.obj.input.value.trim() : _this2.obj.input.textContent.trim();
					if (defaultValue) {
						// 中文处理
						defaultValue = defaultValue.replace(/[\u4e00-\u9fa5]+/g, function ($a, $b) {
							if ($a == '年' || $a == '月') {
								return '/';
							} else if ($a == '时' || $a == '分') {
								return ':';
							} else if ($a == '秒' || $a == '日') {
								return '';
							}
						});
						if (_this2.config.isDouble) {
							var arr = defaultValue.split('-');
							var begintime = arr[1].trim();
							var endtime = arr[0].trim();
							_this2.config.value = _this2.obj.isDoubleOne ? begintime : endtime;
							_this2.config.begintime = endtime;
							_this2.config.endtime = begintime;
						} else {
							_this2.config.value = defaultValue;
						}
					}

					// 过滤重复生成
					if (doc[query](_this2.obj.id)) return;

					// 获得年月日
					var html = _this2.objHTML(); //生成时间选择器HTML
					var divElement = doc.createElement("div");
					divElement.innerHTML = html;
					doc.body.appendChild(divElement);

					_this2.$obj = doc[query](_this2.obj.id);

					switch (_this2.config.type) {
						case 'day':
							_this2.judgeCalendarRender('day', _this2.config.value);
							break;
						case 'year':
							_this2.getYearHtml(_this2.config.value);
							break;
						case 'month':
							_this2.getMonthHtml(_this2.config.value);
							break;
						case 'time':
							_this2.getTimeHtml(_this2.config.value);
							break;
					}

					//定位并显示选择器
					_this2.elemEventPoint(e);
					_this2.documentClick();
					_this2.calendarClick();

					_this2.obj.initVal = _this2.obj.input.value;
				});
				this.config.mounted && this.config.mounted();
			}

			//生成时间选择器区域

		}, {
			key: "objHTML",
			value: function objHTML(json) {
				var html = "<div class=\"zane-calendar\" style=\"width:" + this.config.width + "px;z-index:" + this.config.zindex + "\" id=\"" + this.obj.id.substring(1) + "\">\n\t\t\t\t\t<div class=\"zane-model-miss\"><div class=\"zane-model-mask\"></div><div class=\"zane-model-content\"></div></div>\n\t\t\t\t\t<div class=\"zane-calendar-one left\" style=\"width:" + this.config.width + "px;\">\n\t\t\t\t\t\t<div class=\"zane-date-top\">\n\t\t\t\t\t\t\t<div class=\"common-top top-check-day\"></div>\n\t\t\t\t\t\t\t<div class=\"common-top top-check-year\"></div>\t\n\t\t\t\t\t\t\t<div class=\"common-top top-check-month\"></div>\t\n\t\t\t\t\t\t\t<div class=\"common-top top-check-time\"></div>\t\t\n\t\t\t\t\t\t</div>\n\t\t\t\t\t\t<div class=\"zane-date-main\" style=\"height:" + (this.config.height - 80) + "px\">\n\t\t\t\t\t\t\t<div class=\"common-main main-check-day\"></div>\n\t\t\t\t\t\t\t<div class=\"common-main main-check-year\"></div>\n\t\t\t\t\t\t\t<div class=\"common-main main-check-month\"></div>\n\t\t\t\t\t\t\t<div class=\"common-main main-check-time\"></div>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t\t<div class=\"zane-date-bottom\" style=\"display:" + (this.config.haveBotBtns || this.config.isDouble ? 'block' : 'none') + ";\n\t\t\t\t\t\t\t\t\t\t\t\tborder-left:" + (this.obj.isDoubleOne ? 'none' : 'solid 1px #eee') + ";\">\n\t\t\t\t\t\t\t<div class=\"btn-select-time\" style=\"display:" + (this.config.showtime ? 'blcok' : 'none') + "\">\n\t\t\t\t\t\t\t\t<div class=\"zane-date-left button btn-select-time-item\" onclick=\"" + this.config.calendarName + ".getTimeHtml()\">" + this.obj.lang.timeTips + "</div>\n\t\t\t\t\t\t\t</div>\t\n\t\t\t\t \t\t\t<div class=\"zane-date-right\">\n\t\t\t\t\t\t\t\t<div class=\"button " + (this.config.shownow ? 'no-right-line' : '') + "\" \n\t\t\t\t\t\t\t\t\tstyle=\"display:" + (this.config.showclean ? 'blcok' : 'none') + "\"\n\t\t\t\t\t\t\t\t\tonclick=\"" + this.config.calendarName + ".cleanInputVal()\">" + this.obj.lang.tools.clear + "</div>\n\t\t\t\t\t\t\t\t<div class=\"button " + (this.config.showsubmit ? 'no-right-line' : '') + "\"\n\t\t\t\t\t\t\t\t\tstyle=\"display:" + (this.config.shownow && !this.config.min || this.config.shownow && !this.config.max ? 'blcok' : 'none') + "\" \n\t\t\t\t\t\t\t\t\tonclick=\"" + this.config.calendarName + ".changeToToday()\">" + this.obj.lang.tools.now + "</div>\n\t\t\t\t\t\t\t\t<div class=\"button\" \n\t\t\t\t\t\t\t\t\tstyle=\"display:" + (this.config.showsubmit ? 'blcok' : 'none') + "\"\n\t\t\t\t\t\t\t\t\tonclick=\"" + this.config.calendarName + ".makeSureSelectTime()\">" + this.obj.lang.tools.confirm + "</div>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>";
				return html;
			}
			// day - top html   时间选择器选择年月块

		}, {
			key: "topCheckDayHTML",
			value: function topCheckDayHTML(json) {
				var html = "\t\n\t\t<div onclick=\"" + this.config.calendarName + ".preMonth(" + json.year + "," + json.month + ")\" class=\"zane-date-icom zane-icon-left\"></div>";
				if (this.config.lang == 'cn') {
					html += "<div class=\"zane-icon-center\">\n\t\t\t\t<span onclick=\"" + this.config.calendarName + ".getYearHtml(" + json.year + ")\">" + json.year + "\u5E74</span>\n\t\t\t\t<span onclick=\"" + this.config.calendarName + ".getMonthHtml(" + json.month + ")\">" + json.month + "\u6708</span>\n\t\t\t</div>";
				} else {
					html += "<div class=\"zane-icon-center\">\n\t\t\t\t<span onclick=\"" + this.config.calendarName + ".getMonthHtml(" + json.month + ")\">" + this.weekToEn(json.month) + "</span>\n\t\t\t\t<span onclick=\"" + this.config.calendarName + ".getYearHtml(" + json.year + ")\">" + json.year + "</span>\n\t\t\t</div>";
				}
				html += "<div onclick=\"" + this.config.calendarName + ".nextMonth(" + json.year + "," + json.month + ")\" class=\"zane-date-icom zane-icon-right\"></div>";
				return html;
			}

			// day - main html 时间选择器选择日期块

		}, {
			key: "mainCheckDayHTML",
			value: function mainCheckDayHTML(json) {
				var html = "\n\t\t<div class=\"week-day\"><table class=\"day\" border=\"0\" cellspacing=\"0\">\n\t\t\t<tr>";
				for (var j = 0, len = 7; j < len; j++) {
					html += "<th>" + this.obj.lang.weeks[j] + "</th>";
				}
				html += "</tr>";
				for (var i = 0, _len = json.datalist.length; i < _len; i++) {
					var className = json.datalist[i].class || "";
					var sele_act = json.datalist[i].sele_act || '';
					if (json.datalist[i].day === parseInt(json.today) && json.datalist[i].daytype === 'now') {
						className += this.config.isDouble ? " act_block" : " active";
					}
					//如果超出min时间或者max时间的，给禁止选中样式
					if (this.config.min != '' && new Date(json.datalist[i].fullday).getTime() < new Date(this.config.min).getTime() || this.config.max != '' && new Date(json.datalist[i].fullday).getTime() > new Date(this.config.max).getTime()) {
						className += " calendar-disabled";
					}
					if (i == 0) {
						html += "<tr><td data-time=\"" + json.datalist[i].fullday + "\" class=\"" + className + " " + sele_act + "\"><span>" + json.datalist[i].day + "</span></td>";
					} else if (i == _len - 1) {
						html += "<td data-time=\"" + json.datalist[i].fullday + "\" class=\"" + className + " " + sele_act + "\"><span>" + json.datalist[i].day + "</span></td></tr>";
					} else {
						if ((i + 1) % 7 == 0) {
							html += "<td data-time=\"" + json.datalist[i].fullday + "\" class=\"" + className + " " + sele_act + "\"><span>" + json.datalist[i].day + "</span></td></tr><tr>";
						} else {
							html += "<td data-time=\"" + json.datalist[i].fullday + "\" class=\"" + className + " " + sele_act + "\"><span>" + json.datalist[i].day + "</span></td>";
						}
					}
				}

				html += "</table></div>";
				return html;
			}

			// year - top html 时间选择器选择年份状态头部

		}, {
			key: "topCheckYearHTML",
			value: function topCheckYearHTML(json) {
				var html = "\n\t\t<div class=\"zane-date-icom zane-icon-left\" onclick=\"" + this.config.calendarName + ".perYear(" + json.nowyear + ")\"></div>\n\t\t<div class=\"zane-icon-center\">\n\t\t\t<span>" + json.firstYear + (this.config.lang == 'cn' ? '年' : '') + "</span>-\n\t\t\t<span>" + json.lastYear + (this.config.lang == 'cn' ? '年' : '') + "</span>\n\t\t</div>\n\t\t<div class=\"zane-date-icom zane-icon-right\" onclick=\"" + this.config.calendarName + ".nextYear(" + json.nowyear + ")\"></div>";
				return html;
			}
			// year - main html 时间选择器选择年份状态内容块

		}, {
			key: "mainCheckYearHTML",
			value: function mainCheckYearHTML(json) {
				var html = "<div class=\"week-day\">\n\t\t\t<table class=\"day border-day\" border=\"0\" cellspacing=\"0\">";
				for (var i = 0, len = json.datalist.length; i < len; i++) {
					var className = json.datalist[i].class || "";
					if (json.datalist[i].year === json.nowyear) {
						className += " active";
					}
					if (i == 0) {
						html += "<tr><td class=\"" + className + "\"><span data-year=\"" + json.datalist[i].year + "\">" + json.datalist[i].year + "</span></td>";
					} else if (i == len - 1) {
						html += "<td class=\"" + className + "\"><span data-year=\"" + json.datalist[i].year + "\">" + json.datalist[i].year + "</span></td></tr>";
					} else {
						if ((i + 1) % 3 == 0) {
							html += "<td class=\"" + className + "\"><span data-year=\"" + json.datalist[i].year + "\">" + json.datalist[i].year + "</span></td></tr><tr>";
						} else {
							html += "<td class=\"" + className + "\"><span data-year=\"" + json.datalist[i].year + "\">" + json.datalist[i].year + "</span></td>";
						}
					}
				}
				html += "</table>\n\t\t</div>";
				return html;
			}

			// month -top html 时间选择器选择月份头部

		}, {
			key: "topCheckMonthHTML",
			value: function topCheckMonthHTML(json) {
				var html = "\n\t\t<div class=\"zane-date-icom zane-icon-left\" style=\"display:" + (this.obj.handleType == 'month' ? 'none' : 'block') + "\" onclick=\"" + this.config.calendarName + ".perMonthYear(" + json.year + "," + json.nowmonth + ")\"></div>\n\t\t<div class=\"zane-icon-center\">\n\t\t\t<span>" + json.year + "\u5E74</span>\n\t\t</div>\n\t\t<div class=\"zane-date-icom zane-icon-right\" style=\"display:" + (this.obj.handleType == 'month' ? 'none' : 'block') + "\" onclick=\"" + this.config.calendarName + ".nextMonthYear(" + json.year + "," + json.nowmonth + ")\"></div>";
				return html;
			}
			// month -main html 时间选择器选择月份状态内容块

		}, {
			key: "mainCheckMonthHTML",
			value: function mainCheckMonthHTML(json) {
				var html = "<div class=\"week-day\">\n\t\t\t<table class=\"day border-day\" border=\"0\" cellspacing=\"0\">";
				for (var i = 0, len = json.datalist.length; i < len; i++) {
					var className = json.datalist[i].class || "";
					if (i + 1 === parseInt(json.nowmonth)) {
						className += " active";
					}
					if (i == 0) {
						html += "<tr><td class=\"" + className + "\"><span data-year=\"" + json.year + "\" data-month=\"" + (i + 1) + "\">" + json.datalist[i] + "</span></td>";
					} else if (i == len - 1) {
						html += "<td class=\"" + className + "\"><span data-year=\"" + json.year + "\" data-month=\"" + (i + 1) + "\">" + json.datalist[i] + "</span></td></tr>";
					} else {
						if ((i + 1) % 3 == 0) {
							html += "<td class=\"" + className + "\"><span data-year=\"" + json.year + "\" data-month=\"" + (i + 1) + "\">" + json.datalist[i] + "</span></td></tr><tr>";
						} else {
							html += "<td class=\"" + className + "\"><span data-year=\"" + json.year + "\" data-month=\"" + (i + 1) + "\">" + json.datalist[i] + "</span></td>";
						}
					}
				}
				html += "</table>\n\t\t</div>";
				return html;
			}

			// time -top  html 时间选择器选择时间状态头部

		}, {
			key: "topCheckTimeHTML",
			value: function topCheckTimeHTML() {
				var html = "<div class=\"zane-icon-center\"><span>" + this.obj.lang.timeTips + "</span></div>";
				return html;
			}
			// time -main html 时间选择器选择时间状态内容块

		}, {
			key: "mainCheckTimeHTML",
			value: function mainCheckTimeHTML(json) {
				var html = "<div class=\"week-day\"><ul class=\"nav " + (this.config.showsecond ? '' : 'nav-1') + "\">\n\t\t\t\t\t\t<li>" + this.obj.lang.time[0] + "</li>\n\t\t\t\t\t\t<li>" + this.obj.lang.time[1] + "</li>\n\t\t\t\t\t\t" + (this.config.showsecond ? '<li>' + this.obj.lang.time[2] + '</li>' : '') + "\n\t\t\t\t\t</ul><div class=\"select-time " + (this.config.showsecond ? '' : 'select-time-1') + "\">\n\t\t\t\t<ul class=\"hour\">";
				for (var i = 0, len = json.hours.length; i < len; i++) {
					var className = '';
					if (json.hours[i] == json.hour) className = 'active';
					html += "<li class=\"" + className + "\" data-time=\"" + json.hours[i] + "\">" + json.hours[i] + "</li>";
				}
				html += "</ul><ul class=\"minute\">";
				for (var _i = 0, _len2 = json.minutes.length; _i < _len2; _i++) {
					var _className = '';
					if (json.minutes[_i] == json.minute) _className = 'active';
					html += "<li class=\"" + _className + "\" data-time=\"" + json.minutes[_i] + "\">" + json.minutes[_i] + "</li>";
				}
				if (this.config.showsecond) {
					html += "</ul><ul class=\"second\">";
					for (var _i2 = 0, _len3 = json.seconds.length; _i2 < _len3; _i2++) {
						var _className2 = '';
						if (json.seconds[_i2] == json.second) _className2 = 'active';
						html += "<li class=\"" + _className2 + "\" data-time=\"" + json.seconds[_i2] + "\">" + json.seconds[_i2] + "</li>";
					}
				}
				html += "</ul></div></div>";
				return html;
			}

			// time -bottom html 时间选择器日期/时间切换块

		}, {
			key: "bottomCheckTimeHTML",
			value: function bottomCheckTimeHTML() {
				var html = '';
				if (this.obj.handleType === 'time') {
					html += "<div class=\"zane-date-left button\" onclick=\"" + this.config.calendarName + ".backDateHtml()\">" + this.obj.lang.dateTips + "</div>";
				} else {
					html += "<div class=\"zane-date-left button\" onclick=\"" + this.config.calendarName + ".getTimeHtml()\">" + this.obj.lang.timeTips + "</div>";
				}
				return html;
			}

			// 插件位置定位并显示

		}, {
			key: "elemEventPoint",
			value: function elemEventPoint(e) {
				var secElement = e.srcElement || e.target;
				this.obj.calendar = this.$obj;
				var rectObject = secElement.getBoundingClientRect();
				var objOffsetLeft = rectObject.left;
				var objOffsetTop = rectObject.top;
				var winWidth = doc.documentElement.clientWidth;
				var screenClientHeight = doc.documentElement.clientHeight;
				var screenScrolTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
				var objOffsetHeight = e.target.offsetHeight;
				var objBotton = screenClientHeight - (objOffsetTop + objOffsetHeight + this.config.behindTop);
				var betweenRight = winWidth - objOffsetLeft - this.config.width;
				var calendHeight = this.$obj.offsetHeight;
				this.obj.calendar.style.display = 'block';

				// 设置插件point位置
				if (this.obj.isDoubleOne && betweenRight >= this.config.width) {
					this.obj.calendar.style.left = objOffsetLeft + this.config.width + 'px';
				} else {
					this.obj.calendar.style.left = objOffsetLeft + 'px';
				};
				//double 处理
				if (objBotton > calendHeight) {
					//插件在input框之下 
					this.config.isDouble && this.obj.isDoubleOne && betweenRight < this.config.width ? this.obj.calendar.style.top = objOffsetTop + screenScrolTop + objOffsetHeight + this.config.behindTop + calendHeight - 2 - 40 + 'px' : this.obj.calendar.style.top = objOffsetTop + screenScrolTop + objOffsetHeight + this.config.behindTop + 'px';
				} else {
					//插件在input框之上
					this.config.isDouble && !this.obj.isDoubleOne && betweenRight < this.config.width ? this.obj.calendar.style.top = objOffsetTop + screenScrolTop - this.config.behindTop - calendHeight * 2 + 42 + 'px' : this.obj.calendar.style.top = objOffsetTop + screenScrolTop - this.config.behindTop - calendHeight + 'px';
				}
			}

			// 插件数据渲染

		}, {
			key: "getTimeDates",
			value: function getTimeDates(deraultDay, clickType) {
				var _this3 = this;

				var timeDatas = [];
				var date = deraultDay ? new Date(deraultDay) : new Date();
				var year = date.getFullYear();
				var month = date.getMonth() + 1;
				var toDate = date.getDate();
				var weekday = date.getDay();
				var hour = date.getHours();
				var minute = date.getMinutes();
				var second = date.getSeconds();
				// double 处理
				if (this.config.isDouble && this.obj.isDoubleOne && clickType == 'next') {
					if (month > 12) {
						year = year + 1;
						month = 1;
					}
				} else if (this.config.isDouble && !this.obj.isDoubleOne && clickType == 'pre') {
					if (month < 1) {
						year = year - 1;
						month = 12;
					}
				}
				month = (month + '').length < 2 ? '0' + month : month;
				toDate = (toDate + '').length < 2 ? '0' + toDate : toDate;
				hour = (hour + '').length < 2 ? '0' + hour : hour;
				minute = (minute + '').length < 2 ? '0' + minute : minute;
				second = (second + '').length < 2 ? '0' + second : second;
				// 计算当前这个月的天数
				var monTotalDay = new Date(year, month, 0).getDate();
				// 计算第一天是周几
				var firstDayMeek = new Date(year + "/" + month + "/1").getDay();
				var lastDayMeek = new Date(year + "/" + month + "/" + monTotalDay).getDay();
				var preweek = null;
				var preday = null;
				// 计算需要补充的时间
				if (firstDayMeek > 0) {
					var preMonTotalDay = new Date(year, month - 1, 0).getDate();
					var _preyear = year;
					var _premonth = month - 1;
					if (_premonth === 0) {
						_preyear = year - 1;
						_premonth = 12;
					}
					for (var i = 0, len = firstDayMeek; i < len; i++) {
						var day = preMonTotalDay - i;
						_premonth = (_premonth + '').length < 2 ? '0' + _premonth : _premonth;
						day = (day + '').length < 2 ? '0' + day : day;
						var fullday = _preyear + "/" + _premonth + "/" + day;
						var sele_act = this.hasSelectAct(fullday, this.config.begintime, this.config.endtime) ? 'sele_act' : '';

						timeDatas.push({
							day: preMonTotalDay - i,
							week: len - 1 - i,
							class: 'light',
							sele_act: sele_act,
							daytype: "pre",
							fullday: fullday
						});
					}
				}
				timeDatas = timeDatas.reverse();
				for (var _i3 = 0, _len4 = monTotalDay; _i3 < _len4; _i3++) {
					var _weekday = (firstDayMeek + _i3) % 7;
					var _premonth2 = month;
					var _day = _i3 + 1;
					_premonth2 = (_premonth2 + '').length < 2 ? '0' + _premonth2 : _premonth2;
					_day = (_day + '').length < 2 ? '0' + _day : _day;
					var _fullday = year + "/" + _premonth2 + "/" + _day;
					var _sele_act = this.hasSelectAct(_fullday, this.config.begintime, this.config.endtime) ? 'sele_act' : '';

					timeDatas.push({
						day: _i3 + 1,
						week: _weekday,
						daytype: "now",
						sele_act: _sele_act,
						fullday: _fullday
					});
					if (_i3 === _len4 - 1) {
						preweek = _weekday;
						preday = _i3 + 1;
					}
				}

				var totalLength = timeDatas.length;
				var haveNeedLength = 42 - totalLength;

				var preyear = year;
				var premonth = parseInt(month) + 1;
				if (premonth === 13) {
					preyear = year + 1;
					premonth = 1;
				}

				for (var i = 0; i < haveNeedLength; i++) {
					var _weekday2 = (preweek + 1 + i) % 7;
					var _day2 = i + 1;
					premonth = (premonth + '').length < 2 ? '0' + premonth : premonth;
					_day2 = (_day2 + '').length < 2 ? '0' + _day2 : _day2;
					var _fullday2 = preyear + "/" + premonth + "/" + _day2;
					var _sele_act2 = this.hasSelectAct(_fullday2, this.config.begintime, this.config.endtime) ? 'sele_act' : '';

					timeDatas.push({
						day: i + 1,
						week: _weekday2,
						class: 'light',
						sele_act: _sele_act2,
						daytype: "next",
						fullday: _fullday2
					});
				}
				setTimeout(function () {
					if (!_this3.config.begintime && !_this3.config.endtime) _this3.setBeginEndTime(year + "/" + month + "/" + toDate);
				}, 1000);
				return {
					year: year,
					month: month,
					today: toDate,
					hour: hour,
					minute: minute,
					second: second,
					datalist: timeDatas
				};
			}
		}, {
			key: "hasSelectAct",
			value: function hasSelectAct(nowTime, beginTime, endTime) {
				var result = false;
				if (this.config.isDouble && this.config.begintime && this.config.endtime) {
					nowTime = typeof nowTime === 'number' ? nowTime : new Date(nowTime).getTime();
					beginTime = typeof beginTime === 'number' ? beginTime : new Date(beginTime.replace(/-/g, '/')).getTime();
					endTime = typeof endTime === 'number' ? endTime : new Date(endTime.replace(/-/g, '/')).getTime();
					if (nowTime >= beginTime && nowTime <= endTime) result = true;
				}
				return result;
			}

			// 选择上一月

		}, {
			key: "preMonth",
			value: function preMonth(year, month) {
				month = month - 1;
				if (month == 0) {
					month = 12;
					year = year - 1;
				}
				var today = this.obj.fulldatas.today;
				var totalday = new Date(year, month, 0).getDate();
				if (today > totalday) today = totalday;
				var fulldate = year + "/" + month + "/" + today;
				var isreset = this.config.isDouble && this.obj.isDoubleOne ? true : false;
				this.setBeginEndTime(fulldate);
				this.judgeCalendarRender('day', fulldate, isreset, 'pre');
			}

			// 选择下一月

		}, {
			key: "nextMonth",
			value: function nextMonth(year, month) {
				month = month + 1;
				if (month == 13) {
					month = 1;
					year = year + 1;
				}
				var today = this.obj.fulldatas.today;
				var totalday = new Date(year, month, 0).getDate();
				if (today > totalday) today = totalday;
				var fulldate = year + "/" + month + "/" + today;
				var isreset = this.config.isDouble && !this.obj.isDoubleOne ? true : false;
				this.setBeginEndTime(fulldate);
				this.judgeCalendarRender('day', fulldate, isreset, 'next');
			}
		}, {
			key: "setBeginEndTime",
			value: function setBeginEndTime(dataTime) {
				if (this.config.isDouble) {
					if (!this.obj.isDoubleOne) {
						this.config.begintime = dataTime;
						this.obj.$noDoubleObj.config.begintime = dataTime;
					} else {
						this.config.endtime = dataTime;
						this.obj.$noDoubleObj.config.endtime = dataTime;
					}
				}
			}

			// 获得年月日,如果showtime=true,日期加样式，如果为false,直接设置当前选择的日期

		}, {
			key: "getDay",
			value: function getDay() {
				var _this = this;
				var objs = this.$obj[query]('.main-check-day')[quall]('td');
				// 绑定单击
				this.on(objs, 'click', function (e) {
					var node = e.target.nodeName == 'SPAN' ? e.target.parentNode : e.target;
					if (!_this.hasClass(node, 'calendar-disabled')) {
						//有calendar-disabled样式的不赋予事件
						var dataTime = this.getAttribute('data-time');
						var arr = dataTime.split('/');
						var fulldatas = {
							year: arr[0],
							month: arr[1],
							today: arr[2],
							hour: _this.obj.fulldatas.hour,
							minute: _this.obj.fulldatas.minute,
							second: _this.obj.fulldatas.second
						};
						_this.setBeginEndTime(dataTime);
						if (_this.config.isDouble) {
							var result = _this.compareTimes('getDay', _this.obj.$noDoubleObj.obj.fulldatas, fulldatas);
							if (result) return;
						}
						_this.obj.fulldatas.year = arr[0];
						_this.obj.fulldatas.month = arr[1];
						_this.obj.fulldatas.today = arr[2];
						//选择具体日期添加样式
						_this.addOrRemoveClass(this);
						// double 处理
						if (!_this.config.showtime && !_this.config.isDouble) {
							var value = _this.obj.fulldatas.year + "/" + _this.obj.fulldatas.month + "/" + _this.obj.fulldatas.today;
							_this.getYearMonthAndDay(value, true);
						}
					}
				});
				// 绑定双击
				!this.config.isDouble && this.on(objs, 'dblclick', function (e) {
					var node = e.target.nodeName == 'SPAN' ? e.target.parentNode : e.target;
					if (e.type === 'dblclick' && !_this.hasClass(node, 'calendar-disabled')) _this.makeSureSelectTime();
				});
			}
		}, {
			key: "addOrRemoveClass",
			value: function addOrRemoveClass(that) {
				var _this = this;
				var objs = this.$obj[query]('.main-check-day')[quall]('td');
				if (_this.config.isDouble) {
					var otherobjs = _this.obj.$noDoubleObj.$obj[query]('.main-check-day')[quall]('td');
					_this.forEach(objs, function (index, item) {
						var newtime = item.getAttribute('data-time');
						var result = _this.hasSelectAct(newtime, _this.config.begintime, _this.config.endtime);
						if (that) _this.removeClass(item, 'act_block');
						if (result) {
							if (!_this.hasClass(item, 'sele_act')) _this.addClass(item, 'sele_act');
						} else {
							_this.removeClass(item, 'sele_act');
						}
					});
					_this.forEach(otherobjs, function (index, item) {
						var newtime = item.getAttribute('data-time');
						var result = _this.hasSelectAct(newtime, _this.config.begintime, _this.config.endtime);
						if (result) {
							if (!_this.hasClass(item, 'sele_act')) _this.addClass(item, 'sele_act');
						} else {
							_this.removeClass(item, 'sele_act');
						}
					});
					if (that) _this.addClass(that, 'act_block');
				} else if (that) {
					_this.forEach(objs, function (index, item) {
						_this.removeClass(item, 'active');
					});
					_this.addClass(that, 'active');
				}
			}
		}, {
			key: "compareTimes",
			value: function compareTimes(type, preT, nextT) {
				var preTimes = void 0,
				    nextTimes = void 0,
				    modelText = void 0;
				if (type === 'getDay') {
					preTimes = preT.year + "/" + preT.month + "/" + preT.today + " " + preT.hour + ":" + preT.minute + ":" + preT.second;
					preTimes = new Date(preTimes).getTime();
					nextTimes = nextT.year + "/" + nextT.month + "/" + nextT.today + " " + nextT.hour + ":" + nextT.minute + ":" + nextT.second;
					nextTimes = new Date(nextTimes).getTime();
					modelText = this.config.lang === 'cn' ? '结束时间必须大于开始时间！' : 'The end time must be greater than the start time.';
				} else if (type === 'getYear') {
					preTimes = preT.year;
					nextTimes = nextT.year;
					modelText = this.config.lang === 'cn' ? '结束年份必须大于开始年份！' : 'The end year must be greater than the beginning year.';
				} else if (type === 'getMonth') {
					preTimes = parseInt(preT.month);
					nextTimes = parseInt(nextT.month);
					modelText = this.config.lang === 'cn' ? '结束月份必须大于开始月份！' : 'The end month must be greater than the beginning month.';
				} else if (type === 'selectTime') {
					preTimes = "2018/01/01 " + preT.hour + ":" + preT.minute + ":" + preT.second;
					preTimes = new Date(preTimes).getTime();
					nextTimes = "2018/01/01 " + nextT.hour + ":" + nextT.minute + ":" + nextT.second;
					nextTimes = new Date(nextTimes).getTime();
					modelText = this.config.lang === 'cn' ? '结束时间必须大于开始时间！' : 'The end time must be greater than the start time.';
				}

				var result = false;
				var isShowTime = this.config.showtime || this.obj.$noDoubleObj.config.showtime;
				if (this.obj.isDoubleOne && nextTimes <= preTimes && !isShowTime || this.obj.isDoubleOne && nextTimes < preTimes && isShowTime) result = true;
				if (!this.obj.isDoubleOne && nextTimes >= preTimes && !isShowTime || !this.obj.isDoubleOne && nextTimes > preTimes && isShowTime) result = true;
				var timer = null;
				if (result) {
					clearTimeout(timer);
					var modelObj = this.$obj[query]('.zane-model-miss');
					modelObj.style.display = 'block';
					this.$obj[query]('.zane-model-content').innerHTML = modelText;
					timer = setTimeout(function () {
						modelObj.style.display = 'none';
					}, 1000);
				}
				return result;
			}

			// 获得年html

		}, {
			key: "getYearHtml",
			value: function getYearHtml(year, isreset, clickType) {
				year = year || new Date().getFullYear();
				year = parseInt(year);
				// double 处理
				if (this.config.isDouble && this.obj.isDoubleOne && clickType == 'next') {
					year = year + this.obj.totalYear;
				} else if (this.config.isDouble && !this.obj.isDoubleOne && clickType == 'pre') {
					year = year - this.obj.totalYear;
				}
				var yearDatas = {
					nowyear: year,
					datalist: []
				};
				for (var i = 0; i < this.obj.totalYear; i++) {
					var getyear = year - Math.floor(this.obj.totalYear / 2) + i;
					if (i === 0) yearDatas.firstYear = getyear;
					if (i === this.obj.totalYear - 1) yearDatas.lastYear = getyear;
					yearDatas.datalist.push({
						class: '',
						year: getyear
					});
				}

				this.obj.fulldatas.year = this.config.isDouble ? yearDatas.nowyear : '';
				this.judgeCalendarRender('year', yearDatas, isreset, clickType);
			}

			// 上一年

		}, {
			key: "perYear",
			value: function perYear(year) {
				year = year - this.obj.totalYear;
				var isreset = this.config.isDouble && this.obj.isDoubleOne ? true : false;
				this.getYearHtml(year, isreset, 'pre');
			}

			// 下一年

		}, {
			key: "nextYear",
			value: function nextYear(year) {
				year = year + this.obj.totalYear;
				var isreset = this.config.isDouble && !this.obj.isDoubleOne ? true : false;
				this.getYearHtml(year, isreset, 'next');
			}

			// 获得年

		}, {
			key: "getYear",
			value: function getYear() {
				var _this = this;
				var objs = this.$obj[query]('.main-check-year')[quall]('td');
				this.on(objs, 'click', function (e) {
					var year = e.target.nodeName === 'TD' ? e.target.children[0].getAttribute('data-year') : e.target.getAttribute('data-year');
					var fulldate = year + "/" + _this.obj.fulldatas.month + "/" + _this.obj.fulldatas.today;
					if (_this.config.type === 'year') {
						if (_this.config.isDouble) {
							var result = _this.compareTimes('getYear', _this.obj.$noDoubleObj.obj.fulldatas, { year: year });
							if (result) return;
						}
						_this.config.isDouble ? _this.obj.fulldatas.year = year : _this.getYearMonthAndDay(year, false);
					} else {
						//double 处理
						var clickType = _this.obj.isDoubleOne ? 'pre' : '';
						_this.setBeginEndTime(fulldate);
						_this.judgeCalendarRender('day', fulldate, true, clickType);
					}

					//选择具体日期添加样式
					_this.forEach(objs, function (index, item) {
						_this.removeClass(item, 'active');
					});
					_this.addClass(this, 'active');
				});
			}

			// 获得month html

		}, {
			key: "getMonthHtml",
			value: function getMonthHtml(month) {
				var date = new Date();
				var year = this.obj.fulldatas.year || date.getFullYear();
				month = month || date.getMonth() + 1;
				var monthDatas = {
					nowmonth: month,
					year: year,
					datalist: this.obj.lang.month
				};
				this.obj.fulldatas.month = this.config.isDouble ? monthDatas.nowmonth : '';
				this.judgeCalendarRender('month', monthDatas);
			}

			// 上一月

		}, {
			key: "perMonthYear",
			value: function perMonthYear(year, month) {
				var monthDatas = {
					nowmonth: month,
					year: year - 1,
					datalist: this.obj.lang.month
				};
				this.judgeCalendarRender('month', monthDatas);
			}

			// 下一月

		}, {
			key: "nextMonthYear",
			value: function nextMonthYear(year, month) {
				var monthDatas = {
					nowmonth: month,
					year: year + 1,
					datalist: this.obj.lang.month
				};
				this.judgeCalendarRender('month', monthDatas);
			}

			// 获得月

		}, {
			key: "getMonth",
			value: function getMonth() {
				var _this = this;
				var objs = this.$obj[query]('.main-check-month')[quall]('td');
				this.on(objs, 'click', function (e) {
					var obj = e.target.nodeName === 'TD' ? e.target.children[0] : e.target;
					var year = obj.getAttribute('data-year');
					var month = obj.getAttribute('data-month');
					var fulldate = year + "/" + month + "/" + _this.obj.fulldatas.today;
					if (_this.config.type === 'month') {
						if (_this.config.isDouble) {
							var result = _this.compareTimes('getMonth', _this.obj.$noDoubleObj.obj.fulldatas, { month: month });
							if (result) return;
						}
						_this.config.isDouble ? _this.obj.fulldatas.month = month : _this.getYearMonthAndDay(month, false);
					} else {
						var clickType = _this.obj.isDoubleOne ? 'pre' : '';
						_this.setBeginEndTime(fulldate);
						_this.judgeCalendarRender('day', fulldate, true, clickType);
					}
					//选择具体日期添加样式
					_this.forEach(objs, function (index, item) {
						_this.removeClass(item, 'active');
					});
					_this.addClass(this, 'active');
				});
			}

			// 获得时间HTML

		}, {
			key: "getTimeHtml",
			value: function getTimeHtml(time) {
				//double 处理
				if (this.config.isDouble && !this.obj.isDoubleOne && this.config.type == 'day') this.obj.$noDoubleObj.getTimeHtml();
				var nowday = new Date().Format('yyyy/MM/dd');
				var date = time ? new Date(nowday + ' ' + time) : new Date();
				var hour = date.getHours();
				var minute = date.getMinutes();
				var second = date.getSeconds();
				hour = (hour + '').length < 2 ? '0' + hour : hour;
				minute = (minute + '').length < 2 ? '0' + minute : minute;
				second = (second + '').length < 2 ? '0' + second : second;

				this.obj.fulldatas.hour = this.obj.fulldatas.hour || hour;
				this.obj.fulldatas.minute = this.obj.fulldatas.minute || minute;
				this.obj.fulldatas.second = this.obj.fulldatas.second || second;

				var datas = {
					hour: this.obj.fulldatas.hour,
					minute: this.obj.fulldatas.minute,
					second: this.obj.fulldatas.second,
					hours: [],
					minutes: [],
					seconds: []
				};
				for (var i = 0; i < 24; i++) {
					if (i < 10) {
						datas.hours.push('0' + i);
					} else {
						datas.hours.push(i + '');
					}
				}
				for (var i = 0; i < 60; i++) {
					if (i < 10) {
						datas.minutes.push('0' + i);
						datas.seconds.push('0' + i);
					} else {
						datas.minutes.push(i + '');
						datas.seconds.push(i + '');
					}
				}
				this.judgeCalendarRender('time', datas);
			}

			// 选择时间

		}, {
			key: "selectTime",
			value: function selectTime() {
				var _this = this;
				var hourObjs = this.$obj[query]('ul.hour')[quall]('li');
				var minuteObjs = this.$obj[query]('ul.minute')[quall]('li');

				var secondObjs = null;
				if (this.config.showsecond) {
					secondObjs = this.$obj[query]('ul.second')[quall]('li');
				}

				this.on(hourObjs, 'click', function (e) {
					_this.forEach(hourObjs, function (index, item) {
						_this.removeClass(item, 'active');
					});
					_this.addClass(this, 'active');
					_this.obj.fulldatas.hour = this.getAttribute('data-time');
				});

				this.on(minuteObjs, 'click', function (e) {
					if (_this.config.isDouble && !_this.config.showsecond) {
						var result = _this.compareTimes('selectTime', _this.obj.$noDoubleObj.obj.fulldatas, Object.assign({}, _this.obj.fulldatas, { minute: this.getAttribute('data-time') }));
						if (result) return;
					}
					_this.forEach(minuteObjs, function (index, item) {
						_this.removeClass(item, 'active');
					});
					_this.addClass(this, 'active');
					_this.obj.fulldatas.minute = this.getAttribute('data-time');
				});

				if (this.config.showsecond) {
					this.on(secondObjs, 'click', function (e) {
						if (_this.config.isDouble) {
							var result = _this.compareTimes('selectTime', _this.obj.$noDoubleObj.obj.fulldatas, Object.assign({}, _this.obj.fulldatas, { second: this.getAttribute('data-time') }));
							if (result) return;
						}
						_this.forEach(secondObjs, function (index, item) {
							_this.removeClass(item, 'active');
						});
						_this.addClass(this, 'active');
						_this.obj.fulldatas.second = this.getAttribute('data-time');
					});
				}
			}

			// 返回日期

		}, {
			key: "backDateHtml",
			value: function backDateHtml() {
				//double 处理
				if (this.config.isDouble && !this.obj.isDoubleOne && this.config.type == 'day') this.obj.$noDoubleObj.backDateHtml();
				this.obj.handleType = 'date';
				var bottomHTML = this.bottomCheckTimeHTML();
				this.renderCommonHtml('day', '', '', bottomHTML, false);
			}

			// 今天

		}, {
			key: "changeToToday",
			value: function changeToToday() {
				var json = this.getTimeDates();
				var value = null;
				var isFormat = true;
				if (this.config.showtime) {
					value = json.year + "/" + json.month + "/" + json.today + " " + json.hour + ":" + json.minute + ":" + json.second;
				} else if (this.config.type == 'time') {
					isFormat = false;
					value = json.hour + ":" + json.minute + ":" + json.second;
				} else {
					value = json.year + "/" + json.month + "/" + json.today;
				}
				this.getYearMonthAndDay(value, isFormat);
			}

			// 清空

		}, {
			key: "cleanInputVal",
			value: function cleanInputVal() {
				var value = "";
				this.getYearMonthAndDay(value, false);
			}

			// 确定

		}, {
			key: "makeSureSelectTime",
			value: function makeSureSelectTime() {
				var value = null;
				var isFormat = true;
				if (this.config.showtime) {
					value = this.obj.fulldatas.year + "/" + this.obj.fulldatas.month + "/" + this.obj.fulldatas.today + " " + this.obj.fulldatas.hour + ":" + this.obj.fulldatas.minute;
					if (this.config.showsecond) {
						value = value + ":" + this.obj.fulldatas.second;
					}
				} else if (this.config.type == 'time' && !this.config.isDouble) {
					isFormat = false;
					value = this.obj.fulldatas.hour + ":" + this.obj.fulldatas.minute;
					if (this.config.showsecond) {
						value = value + ":" + this.obj.fulldatas.second;
					}
				} else {
					//doubule 处理
					if (this.config.isDouble) {
						var noDoubleData = this.obj.$noDoubleObj.obj.fulldatas;
						var noDoubleStr = void 0,
						    haveDoubleStr = void 0;

						switch (this.config.type) {
							case 'day':
								if (this.obj.$noDoubleObj.config.showtime) {
									noDoubleStr = noDoubleData.year + "-" + noDoubleData.month + "-" + noDoubleData.today + " " + noDoubleData.hour + ":" + noDoubleData.minute;
									haveDoubleStr = this.obj.fulldatas.year + "-" + this.obj.fulldatas.month + "-" + this.obj.fulldatas.today + " " + this.obj.fulldatas.hour + ":" + this.obj.fulldatas.minute;
									if (this.obj.$noDoubleObj.config.showsecond) {
										noDoubleStr = noDoubleStr + ":" + noDoubleData.second;
										haveDoubleStr = haveDoubleStr + ":" + this.obj.fulldatas.second;
									}
								} else {
									noDoubleStr = noDoubleData.year + "/" + noDoubleData.month + "/" + noDoubleData.today;
									haveDoubleStr = this.obj.fulldatas.year + "-" + this.obj.fulldatas.month + "-" + this.obj.fulldatas.today;
								};
								break;
							case 'year':
								isFormat = false;
								noDoubleStr = "" + noDoubleData.year;
								haveDoubleStr = "" + this.obj.fulldatas.year;
								break;
							case 'month':
								isFormat = false;
								noDoubleStr = "" + noDoubleData.month;
								haveDoubleStr = "" + this.obj.fulldatas.month;
								break;
							case 'time':
								isFormat = false;
								noDoubleStr = noDoubleData.hour + ":" + noDoubleData.minute;
								haveDoubleStr = this.obj.fulldatas.hour + ":" + this.obj.fulldatas.minute;
								if (this.config.showsecond) {
									noDoubleStr = noDoubleStr + ":" + noDoubleData.second;
									haveDoubleStr = haveDoubleStr + ":" + this.obj.fulldatas.second;
								}
								break;
						};
						value = noDoubleStr + '|' + haveDoubleStr;
					} else {
						value = this.obj.fulldatas.year + "-" + this.obj.fulldatas.month + "-" + this.obj.fulldatas.today;
					}
				}
				this.getYearMonthAndDay(value, isFormat);
			}

			// 确定年月日的值并在input里面显示，时间选择器隐藏

		}, {
			key: "getYearMonthAndDay",
			value: function getYearMonthAndDay(datatime) {
				var isFormat = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;

				var formatTime = null;
				var begintime = '';
				var endtime = '';

				//doubule 处理
				if (datatime && datatime.indexOf('|') != -1) {
					var arr = datatime.split('|');
					var val1 = null;
					var val2 = null;
					if (isFormat) {
						val1 = begintime = new Date(arr[0]).Format(this.config.format);
						val2 = endtime = new Date(arr[1]).Format(this.config.format);
					} else {
						val1 = begintime = arr[0];
						val2 = endtime = arr[1];
					}
					formatTime = val1 + ' - ' + val2;
				} else {
					formatTime = begintime = isFormat ? new Date(datatime).Format(this.config.format) : datatime;
				}

				if (this.obj.input.nodeName !== 'INPUT') {
					this.obj.input.textContent = formatTime;
				} else {
					this.obj.input.value = formatTime;
				}

				// 移除事件插件dom元素
				this.removeCalendar();

				this.config.done && this.config.done(formatTime, begintime, endtime);
				if (this.obj.initVal != formatTime && this.config.change) this.config.change(formatTime, begintime, endtime);
			}

			// 判断插件渲染类型 day | year | month | time

		}, {
			key: "judgeCalendarRender",
			value: function judgeCalendarRender(type, any, isreset, clickType) {
				var _this4 = this;

				var mainHTML = void 0,
				    topHTML = void 0,
				    bottomHTML = void 0;
				switch (type) {
					case 'day':
						this.obj.handleType = 'day';
						var json = this.getTimeDates(any, clickType);
						this.obj.fulldatas = json;
						// double 处理
						this.compareSize(isreset, clickType);
						topHTML = this.topCheckDayHTML(json);
						mainHTML = this.mainCheckDayHTML(json);
						this.renderCommonHtml('day', topHTML, mainHTML);
						// 计算表格高度
						this.countHeight('.main-check-day', 7);
						this.getDay();
						setTimeout(function () {
							_this4.addOrRemoveClass();
						}, 200);

						break;
					case 'year':
						this.obj.handleType = 'year';
						// double 处理
						this.compareSize(isreset, clickType);
						mainHTML = this.mainCheckYearHTML(any);
						topHTML = this.topCheckYearHTML(any);
						this.renderCommonHtml('year', topHTML, mainHTML);
						// 计算表格高度
						this.countHeight('.main-check-year', 6);
						this.getYear();
						break;
					case 'month':
						this.obj.handleType = 'month';
						mainHTML = this.mainCheckMonthHTML(any);
						topHTML = this.topCheckMonthHTML(any);
						this.renderCommonHtml('month', topHTML, mainHTML);
						// 计算表格高度
						this.countHeight('.main-check-month', 4);
						this.getMonth();
						break;
					case 'time':
						this.obj.handleType = 'time';
						mainHTML = this.mainCheckTimeHTML(any);
						topHTML = this.topCheckTimeHTML();
						bottomHTML = this.bottomCheckTimeHTML();
						this.renderCommonHtml('time', topHTML, mainHTML, bottomHTML);
						this.$obj[query]('.select-time').style.height = this.config.height - 115 + 'px';
						var hourScrollTop = this.$obj[query]('ul.hour')[query]('li.active').offsetTop;
						var minuteScrollTop = this.$obj[query]('ul.minute')[query]('li.active').offsetTop;

						this.$obj[query]('ul.hour').scrollTop = hourScrollTop - 150;
						this.$obj[query]('ul.minute').scrollTop = minuteScrollTop - 150;

						if (this.config.showsecond) {
							var secondScrollTop = this.$obj[query]('ul.second')[query]('li.active').offsetTop;
							this.$obj[query]('ul.second').scrollTop = secondScrollTop - 150;
						}

						this.selectTime();
						break;
				}
			}
		}, {
			key: "renderCommonHtml",
			value: function renderCommonHtml(type, topHTML, mainHTML, bottomHTML) {
				var isrender = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : true;

				if (type == 'time' || !isrender) this.$obj[query](".btn-select-time").innerHTML = bottomHTML;
				if (isrender) {
					this.$obj[query](".top-check-" + type).innerHTML = topHTML;
					this.$obj[query](".main-check-" + type).innerHTML = mainHTML;
				};
				this.showOrHide(this.$obj[quall]('.common-top'), 'hide');
				this.showOrHide(this.$obj[quall]('.common-main'), 'hide');
				this.$obj[query](".main-check-" + type).style.display = 'block';
				this.$obj[query](".top-check-" + type).style.display = 'block';
			}

			// 比较double数据之间的大小，并从新赋值

		}, {
			key: "compareSize",
			value: function compareSize(isreset, clickType) {
				if (!isreset) return;
				// double 处理
				var prev = this.obj.fulldatas;
				var next = this.obj.$noDoubleObj;
				if (this.config.isDouble && prev && next) {
					next = next.obj.fulldatas;
					if (this.obj.isDoubleOne) {
						this.getDoubleTime({
							prev: next,
							next: prev,
							clickType: clickType
						});
					} else {
						this.getDoubleTime({
							prev: prev,
							next: next,
							clickType: clickType
						});
					}
				};
			}
		}, {
			key: "getDoubleTime",
			value: function getDoubleTime(json) {
				var nextfullstr = void 0,
				    prefullstr = void 0,
				    perTime = void 0,
				    nextTime = void 0;
				switch (this.config.type) {
					case 'day':
						prefullstr = json.prev.year + "/" + json.prev.month + "/" + json.prev.today;
						nextfullstr = json.next.year + "/" + json.next.month + "/" + json.next.today;
						perTime = new Date(prefullstr).getTime();
						nextTime = new Date(nextfullstr).getTime();
						if (perTime >= nextTime - 86400000) {
							var times = this.obj.isDoubleOne ? nextTime - 86400000 : perTime + 86400000;
							this.obj.$noDoubleObj.setBeginEndTime(times);
							this.obj.$noDoubleObj.judgeCalendarRender('day', times, false, json.clickType);
						}
						break;
					case 'year':
						perTime = "" + json.prev.year;
						nextTime = "" + json.next.year;
						if (perTime >= nextTime) {
							this.obj.$noDoubleObj.getYearHtml(nextTime, false, json.clickType);
						}
						break;
				}
			}

			//插件自身点击阻止冒泡

		}, {
			key: "calendarClick",
			value: function calendarClick() {
				this.on(this.obj.calendar, 'click', function (e) {
					e.preventDefault();
					e.stopPropagation();
				});
			}

			// 继承方法

		}, {
			key: "extend",
			value: function extend(obj1, obj2) {
				return Object.assign(obj1, obj2);
			}
		}, {
			key: "hasClass",
			value: function hasClass(obj, cls) {
				return obj.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
			}
		}, {
			key: "addClass",
			value: function addClass(obj, cls) {
				if (!this.hasClass(obj, cls)) obj.className += " " + cls;
			}
		}, {
			key: "removeClass",
			value: function removeClass(obj, cls) {
				if (this.hasClass(obj, cls)) {
					var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
					obj.className = obj.className.replace(reg, ' ');
				}
			}

			//对象遍历

		}, {
			key: "forEach",
			value: function forEach(obj, fn) {
				var key = void 0;
				if (typeof fn !== 'function') return this;
				obj = obj || [];
				if (Object.prototype.toString.call(obj) == '[object Object]') {
					for (key in obj) {
						if (fn.call(obj[key], key, obj[key])) break;
					}
				} else if (Object.prototype.toString.call(obj) == '[object NodeList]' || Object.prototype.toString.call(obj) == '[object Array]') {
					for (key = 0; key < obj.length; key++) {
						if (fn.call(obj[key], key, obj[key])) break;
					}
				} else {
					fn.call(obj, 0, obj);
				}
				return this;
			}
		}, {
			key: "on",


			//事件绑定
			value: function on(obj, eventName, fn) {
				return this.forEach(obj, function (index, item) {
					item.attachEvent ? item.attachEvent('on' + eventName, function (e) {
						e.target = e.srcElement;
						fn.call(item, e);
					}) : item.addEventListener(eventName, fn, false);
				});
			}
		}, {
			key: "weekToEn",


			//中英文月份枚举
			value: function weekToEn(val) {
				var num = typeof val == 'string' ? parseInt(val) : val;
				return this.obj.en.month[num - 1];
			}

			// 

		}, {
			key: "showOrHide",
			value: function showOrHide(obj, type) {
				for (var i = 0, len = obj.length; i < len; i++) {
					if (type === 'hide') {
						obj[i].style.display = 'none';
					} else {
						obj[i].style.display = 'block';
					}
				}
			}

			// 计算table tr高度

		}, {
			key: "countHeight",
			value: function countHeight(elename, length) {
				var mainH = this.$obj[query]('.zane-date-main').offsetHeight;
				var trObj = this.$obj[query](elename)[quall]('tr');
				var itemH = Math.floor(mainH / length);
				this.forEach(trObj, function (index, item) {
					item.style.height = itemH + 'px';
				});
			}

			// document点击隐藏插件

		}, {
			key: "documentClick",
			value: function documentClick() {
				var _this5 = this;

				this.on(doc, 'click', function (e) {
					_this5.removeCalendar();
				});
			}

			// 移除事件选择器

		}, {
			key: "removeCalendar",
			value: function removeCalendar(calobj) {
				var zaneCalendarObjs = doc[quall]('.zane-calendar');
				if (zaneCalendarObjs && zaneCalendarObjs.length) {
					zaneCalendarObjs.forEach(function (item) {
						var parent = item.parentElement;
						var parents = parent.parentElement;
						var removed = parents.removeChild(parent);
					});
				}
			}
		}]);

		return calendar;
	}();

	;

	// 实例化日期插件 双选择器DOUBLE区分
	var zaneDate = function zaneDate(option) {
		var begintime = void 0,
		    endtime = void 0,
		    format = void 0;
		format = option.format ? option.format.replace(/-/g, '/') : 'yyyy/MM/dd';
		if (option.type) {
			if (option.type.indexOf('time') != -1) format = 'HH:mm:ss';
			if (option.type.indexOf('year') != -1) format = 'yyyy';
			if (option.type.indexOf('month') != -1) format = 'MM';
		}
		option.type = option.type || 'day';

		//处理begintime
		if (option.begintime && typeof option.begintime === 'string') {
			begintime = option.begintime.replace(/-/g, '/');
			if (option.type && option.type.indexOf('time') == -1 || !option.type) {
				begintime = new Date(begintime).Format(format);
			}
		} else if (option.begintime && typeof option.begintime === 'number') {
			begintime = new Date(option.begintime).Format(format);
		}

		// 处理begintime
		if (option.endtime && typeof option.endtime === 'string') {
			endtime = option.endtime.replace(/-/g, '/');
			if (option.type && option.type.indexOf('time') == -1 || !option.type) {
				endtime = new Date(endtime).Format(format);
			}
		} else if (option.endtime && typeof option.endtime === 'number') {
			endtime = new Date(option.endtime).Format(format);
		}

		if (option.type.indexOf('double') != -1) {
			option.type = option.type.replace(/double/, '');
			createCalendar({
				showclean: false,
				shownow: false,
				showsubmit: false,
				isDouble: true,
				value: begintime,
				format: format,
				doublevalue: begintime && endtime ? begintime + ' - ' + endtime : ''
			});
			createCalendar({
				shownow: false,
				showtime: false,
				isDouble: true,
				double: 'DOUBLE',
				value: endtime,
				format: format,
				doublevalue: begintime && endtime ? begintime + ' - ' + endtime : ''
			});
		} else {
			createCalendar({
				format: format,
				value: begintime
			});
		}
		// 新建日期插件
		function createCalendar() {
			var json = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

			var calendarName = option.elem.substring(1);
			calendarName = calendarName.replace(/[_-]/g, '').toUpperCase();
			option.calendarName = json && json.double ? calendarName + json.double : calendarName;
			if (option.width) {
				option.width = option.width < 220 ? 220 : option.width;
				option.width = option.width > 500 ? 500 : option.width;
			}
			if (option.height) {
				option.height = option.height < 240 ? 240 : option.height;
				option.height = option.height > 350 ? 350 : option.height;
			}

			var cloneOption = Object.assign(extendDeep(option), json);
			window[option.calendarName] = new calendar(cloneOption);
		}
		//深度复制
		function extendDeep(parent, child) {
			child = child || {};
			for (var i in parent) {
				if (parent.hasOwnProperty(i)) {
					if (_typeof(parent[i]) === "object") {
						child[i] = Object.prototype.toString.call(parent[i]) === "[object Array]" ? [] : {};
						extendDeep(parent[i], child[i]);
					} else {
						child[i] = parent[i];
					}
				}
			}
			return child;
		};
	};
	if (!noGlobal) window.zaneDate = zaneDate;

	return zaneDate;
});