/**
 * @class Editor
 * @constructor
 */
thaira.uploads.Editor = function (uid, id, pos, config) {
	this._config = config;
	var fields = config.editorFields;

	this._uid = uid;
	this._id = id;

	var doRender = function (transport) {
		// Check for errors

		var json = eval(transport.responseText);
		if (! json.result) {
			alert('Error: ' + json.message);
			return;
		}

		// Create the editor

		var node = $('thaira-uploads-selector' + uid).down('div.editors');
		new Insertion.Bottom(node,
				config.editorTemplate.evaluate({}));

		// Bind the controls

		this._elementNode = node.immediateDescendants().last();

		// Set the cordinates
		$(this._elementNode).setStyle({left: pos[0] + 'px'});
		$(this._elementNode).setStyle({top: pos[1] + 'px'});

		var langSelectorNode = this._elementNode.down('select[name=langs]');
		langSelectorNode.observe('change', this.onLangChanged.bindAsEventListener(this));
		this._defaultLang = langSelectorNode.getValue();

		this._filenameNode = this._elementNode.down('label').down(1);

		if (fields.indexOf('title') >= 0) {
			this._titleNode = this._elementNode.down('input[name=title]');
		} else {
			this._titleNode = $(document.createElement('input'));
		}
		
		if (fields.indexOf('is_protected') >= 0) {
			this._is_protectedNode = this._elementNode.down('input[name=is_protected]');
		} else {
			this._is_protectedNode = $(document.createElement('checkbox'));
		}
		
		
		if (fields.indexOf('password') >= 0) {
			this._passwordNode = this._elementNode.down('input[name=password]');
		} else {
			this._passwordNode = $(document.createElement('input'));
		}

		if (fields.indexOf('description') >= 0) {
			this._descriptionNode = this._elementNode.down('textarea[name=description]');
		} else {
			this._descriptionNode = $(document.createElement('textarea'));
		}

		if (fields.indexOf('tags') >= 0) {
			this._tagsNode = this._elementNode.down('input[name=tags]');
		} else {
			this._tagsNode = $(document.createElement('input'));
		}

		var ok = this._elementNode.down('div.operations').down();
		ok.observe('click', this.onOk.bindAsEventListener(this));

		var cancel = ok.next();
		cancel.observe('click', this.onCancel.bindAsEventListener(this));

		// Store the data

		this._data = json.data;

		// Fill the data

		this._filenameNode.value = json.data.filename;
		this._tagsNode.value = json.data.tags;
		this._is_protectedNode.checked = json.data.is_protected;
		this._passwordNode.value = json.data.password;
		this._currentLang = this._defaultLang;
		this._updateFieldsWithCurrentLang();
	};

	// Load the edition data
	new Ajax.Request(config.actionsUrl + '/getFields', {
		parameters : {uid : uid, id : id},
		onComplete : doRender.bind(this)
	});
}

/**
 * @class Editor
 */
thaira.uploads.Editor.prototype = {
	_config : null,
	_uid : '',
	_id : '',
	_defaultLang : '',
	_currentLang : '',
	_data : [],

	_elementNode : null,
	_filenameNode : null,
	_titleNode : null,
	_is_protectedNode: null,
	_passwordNode: null,
	_descriptionNode : null,
	_tagsNode : null,

	getTitle : function () {
		return this._data.i18n[this._defaultLang].title;
	},

	onOk : function () {
		var t = this;

		this._updateCurrentLangData();

		postData = {
			uid : this._uid,
			id : this._id,
			tags : this._tagsNode.getValue(),
			password : this._passwordNode.getValue(),
			is_protected : this._is_protectedNode.getValue(),
		}
		
		$H(this._data.i18n).each(function (pair) {
			postData['i18n[' + pair.key + '][title]'] = pair.value.title;
			postData['i18n[' + pair.key + '][description]'] = pair.value.description;
		});

		// Send the edition data
		new Ajax.Request(this._config.actionsUrl + '/setFields', {
			parameters : postData,
			onComplete : function () {
				t.onSaved();
				t._elementNode.remove();
			}
		});
	},

	onCancel : function () {
		this._elementNode.remove();
	},

	onLangChanged : function (e) {
		var element = Event.element(e);
		this._updateCurrentLangData();
		this._currentLang = element.getValue();
		this._updateFieldsWithCurrentLang();
	},

	onSaved : function () {
		
	},

	_updateCurrentLangData : function () {
		var lang = this._currentLang;
		this._data.i18n[lang].title = this._titleNode.getValue();
		this._data.i18n[lang].is_protected = this._is_protectedNode.getValue();
		this._data.i18n[lang].password = this._passwordNode.getValue();
		this._data.i18n[lang].description = this._descriptionNode.getValue();
	},

	_updateFieldsWithCurrentLang : function () {
		var lang = this._currentLang;
		this._titleNode.value = this._data.i18n[lang].title;
		this._is_protectedNode.value = this._data.i18n[lang].is_protected;
		this._passwordNode.value = this._data.i18n[lang].password;
		this._descriptionNode.value = this._data.i18n[lang].description;
	}
}