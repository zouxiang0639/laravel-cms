/**
 * 时间:2016年11月27日
 * 作者:707200833
 * 说明:依赖与jQuery和layui, 是基于layui开发的一个省市区联动的小插件, 使用上要基于layui的表单进行使用
 */

(function($){
	var pca = {};
	
	pca.keys = {};
	pca.ckeys = {};
	
	pca.init = function(province, city, area, initprovince, initcity, initarea){//jQuery选择器, 省-市-区
		if(!province || !$(province).length) return; 
		$(province).html('');
		$(province).append('<option selected>请选择</option>');
		for(var i in citys){
			$(province).append('<option value="'+citys[i].value+'">'+citys[i].name+'</option>');
			pca.keys[citys[i].value] = citys[i];
		}
		layui.form('select').render();
		if(initprovince) $(province).next().find('[lay-value="'+initprovince+'"]').click();
		if(!city || !$(city).length) return;
		pca.formRender(city);

		layui.form().on('select(province)', function(data){
		  	var cs = pca.keys[data.value];

		  	$(city).html('');
		  	$(city).append('<option>请选择</option>');
		  	if(cs){
				cs = cs.city;
				for(var i in cs){
					$(city).append('<option value="'+cs[i].value+'">'+cs[i].name+'</option>');
					pca.ckeys[cs[i].value] = cs[i];
				}
				$(city).find('option:eq(1)').attr('selected', true);
		  	}
			layui.form('select').render();
			$(city).next().find('.layui-this').removeClass('layui-this').click();
			pca.formHidden('province', data.value);
			//$('.pca-label-province').html(data.value);//此处可以自己修改 显示的位置, 不想显示可以直接去掉
		}); 
		if(initprovince) $(province).next().find('[lay-value="'+initprovince+'"]').click();
		if(initcity) $(city).next().find('[lay-value="'+initcity+'"]').click();
		if(!area || !$(area).length) return;
		pca.formRender(area);

		layui.form().on('select(city)', function(data){

		  	var cs = pca.ckeys[data.value];
		  	$(area).html('');
		  	$(area).append('<option>请选择</option>');

			if (cs.area){
				$(area).parent().parent().show();
			}else {
				$(area).parent().parent().hide();
			}

		  	if(cs){
		  		cs = cs.area;
				for(var i in cs){
					$(area).append('<option value="'+citys[i].name+'">'+cs[i].name+'</option>');
				}
				$(area).find('option:eq(1)').attr('selected', true);
		  	}

			layui.form('select').render();
			$(area).next().find('.layui-this').removeClass('layui-this').click();
			pca.formHidden('city', data.value);
			//$('.pca-label-city').html(data.value);	//此处可以自己修改 显示的位置, 不想显示可以直接去掉
		});
		layui.form().on('select(area)', function(data){
			pca.formHidden('area', data.value);
			//$('.pca-label-area').html(data.value);	//此处可以自己修改 显示的位置, 不想显示可以直接去掉
		}); 
		if(initprovince) $(province).next().find('[lay-value="'+initprovince+'"]').click();
		if(initcity) $(city).next().find('[lay-value="'+initcity+'"]').click();
		if(initarea) $(area).next().find('[lay-value="'+initarea+'"]').click();
	};
	
	pca.formRender = function(obj){

		$(obj).append('<option>请选择</option>');
		layui.form('select').render();
	};
	
	pca.formHidden = function(obj, val){
		if(!$('#pca-hide-'+obj).length){
			$('body').append('<input id="pca-hide-'+obj+'" type="hidden" value="'+val+'" />');

		}else{
			$('#pca-hide-'+obj).val(val);
		}

	}
	

	
	window.pca = pca;
	return pca;
})($);