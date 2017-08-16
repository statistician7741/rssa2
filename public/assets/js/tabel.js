$(document).ready(function(){
    var data = [];
    var dimensi = [];
    var step = 1;
    $("#tree1-step1").dynatree({
        persist: true,
        checkbox: true,
        selectMode: 3,
		ajaxDefaults: {
			cache: false,
			dataType: "json"
		},
		
        initAjax: {
            url: "/tabel"
        }
    });
	//$("#daftar-tabel").dynatree({
    //    persist: true,
    //    selectMode: 3,
	//	ajaxDefaults: {
	//		cache: false,
	//		dataType: "json"
	//	},
	//	onActivate: function(node) {
	//		if( node.data.url )
	//			window.open(node.data.url, '_self');
	//	},
    //    initAjax: {
    //        url: "?r=tabel/DaftarTabel"
    //    }
    //});
    
    $('#dimensi-step1').change(function(){
        var dim = $(this).val();
        var url;
        if(dim==1){
            url = "?r=tabel";
            $("#cari-step1").attr("placeholder","Cari Topik dan Variabel");
			$("#tree2-step1").hide();
            $("#tree3-step1").hide();
        }else if(dim==2){
            url = "?r=tabel/waktu";
            $("#tree1-step1").hide();
            $("#tree3-step1").hide();
			$("#cari-step1").attr("placeholder","Cari Tahun");
        }else{
            url = "?r=tabel/wilayah";
			$("#cari-step1").attr("placeholder","Cari Wilayah");
            $("#tree1-step1").hide();
            $("#tree2-step1").hide();
        }
        $('#tree'+dim+'-step1').show();
        $('#tree'+dim+'-step1').dynatree({
            persist: true,
            checkbox: true,
            selectMode: 3,
            initAjax: {
                url: url
            }
        });
        
    });
    $('#dimensi-step2').change(function(){
		var url;
        var dim = $('#dimensi-step1').val();
		var t = $(this).val();
		if(dim==1 && t==2){
            url = '?r=tabel/waktu';
			$("#cari-step2").attr("placeholder","Cari Tahun");
        }else if(dim==1 && t==3){
            url = '?r=tabel/wilayah';
			$("#cari-step2").attr("placeholder","Cari Wilayah");
        }else if(dim==2 && t==1){
            url = '?r=tabel';
			$("#cari-step2").attr("placeholder","Cari Topik Variabel");
		}else if(dim==2 && t==3){
            url = '?r=wilayah';	
			$("#cari-step2").attr("placeholder","Cari Wilayah");
        }else if(dim==3 && t==1){
            url = '?r=tabel';
			$("#cari-step2").attr("placeholder","Cari Topik Variabel");
		}else if(dim==3 && t==2){
            url = '?r=tabel/waktu';	
			$("#cari-step2").attr("placeholder","Cari Tahun");
        }
		$("#tree1-step2").hide();
        $("#tree2-step2").hide();
        $("#tree3-step2").hide();
        $("#tree"+t+"-step2").show();
        $("#tree"+t+"-step2").dynatree({
            persist: true,
            checkbox: true,
            selectMode: 3,
			ajaxDefaults: {
				cache: false,
				dataType: "json"
			},
            initAjax: {
                url: url,
                data: {
                    dimensi:dimensi,
                    data:data,
                    step:step
                },
                type:'POST'
            }
        });
    });
    $('#next').click(function(){
        if(step>=4)return;
        step++;
        var url;
        var dim = $('#dimensi-step'+(step-1)).val();
        var tree = $('#tree'+dim+'-step'+(step-1)).dynatree('getTree');
        var nodes = tree.getSelectedNodes();
        var item = [];
        var t;
		if(step<4)
			$('#step').html(step);
        if(step==2){
            if(dim==1){
                $('#dimensi-step2').html('<option value="2">Waktu</option><option value="3">Wilayah</option>');
                url = '?r=tabel/waktu';
                t=2;
            }else if(dim==2){
                $('#dimensi-step2').html('<option value="1">Topik & Variabel</option><option value="3">Wilayah</option>');
                url = '?r=tabel';
                t=1;
            }else if(dim==3){
                $('#dimensi-step2').html('<option value="1">Topik & Variabel</option><option value="2">Waktu</option>');
                url = '?r=tabel';
                t=1;
            }
            data = [];
            dimensi = [];
        }else if(step==3){
            if(dim==1){
                if(dimensi[0]==2){
                    $('#dimensi-span3').html('<input type="hidden" id="dimensi-step3" value="3" /> Wilayah');
                    url = '?r=tabel/wilayah';
                    t=3;
                }else if(dimensi[0]==3){
                    $('#dimensi-span3').html('<input type="hidden" id="dimensi-step3" value="2" /> Waktu');
                    url = '?r=tabel/waktu';
                    t=2;
                }
            }else if(dim==2){
                if(dimensi[0]==1){
                    $('#dimensi-span3').html('<input type="hidden" id="dimensi-step3" value="3" /> Wilayah');
                    url = '?r=tabel/wilayah';
                    t=3;
                }else if(dimensi[0]==3){
                    $('#dimensi-span3').html('<input type="hidden" id="dimensi-step3" value="1" /> Topik & Variabel');
                    url = '?r=tabel';
                    t=1;
                }
            }else if(dim==3){
                if(dimensi[0]==1){
                    $('#dimensi-span3').html('<input type="hidden" id="dimensi-step3" value="2" /> Waktu');
                    url = '?r=tabel/waktu';
                    t=2;
                }else if(dimensi[0]==2){
                    $('#dimensi-span3').html('<input type="hidden" id="dimensi-step3" value="1" /> Topik & Variabel');
                    url = '?r=tabel';
                    t=1;
                }
            }
        }    
        for(var i=0;i<nodes.length;i++){
            if(!nodes[i].hasChildren()){
                item.push(nodes[i].data.key);
            }
        }
        dimensi[step-2] = dim;
        data[step-2] = item;
        if(step==4){
            $('#wizard').hide();
            $('#tabel-loader').show();
            $.ajax({
                url:'?r=tabel/generate',
                type:'POST',
                data:{
                    data:data,
                    dimensi:dimensi
                },
                success: function(response){
                    $('#tabel-hasil').html(response);
                    $('#tabel-loader').hide();
                    $('#tabel-hasil').show();
                    $('#kembali').click(function(){
                        $('#tabel-hasil').hide();
                        $('#wizard').show();
                    });
                    step--;
                }
            });
            return;
        }
        $("#tree1-step"+step).hide();
        $("#tree2-step"+step).hide();
        $("#tree3-step"+step).hide();
        $("#tree"+t+"-step"+step).show();
        //        if($("#tree"+t+"-step"+step).html()==''){
        //            
        //        }
        $("#tree"+t+"-step"+step).dynatree({
            persist: true,
            checkbox: true,
            selectMode: 3,
			ajaxDefaults: {
				cache: false,
				dataType: "json"
			},
            initAjax: {
                url: url,
                data: {
                    dimensi:dimensi,
                    data:data,
                    step:step
                },
                type:'POST'
            }
        });
		if(step==2){
			$("#terpilih").show();
			$("#dim-terpilih").dynatree({
				persist: true,
				selectMode: 3,
				ajaxDefaults: {
					cache: false,
					dataType: "json"
				},
				initAjax: {
					url: "?r=tabel/terpilih",
					data: {
						dimensi:dimensi,
						data:data,
						step:step
					},
					type:'POST'
				}
			});
			$("#dim-terpilih").dynatree('getTree').reload();
		}else if(step==3){
			$("#dim-terpilih").dynatree({
				persist: true,
				selectMode: 3,
				ajaxDefaults: {
					cache: false,
					dataType: "json"
				},
				initAjax: {
					url: "?r=tabel/terpilih",
					data: {
						dimensi:dimensi,
						data:data,
						step:step
					},
					type:'POST'
				}
			});
			$("#dim-terpilih").dynatree('getTree').reload();
		}
		
		$("#tree"+t+"-step"+step).dynatree('getTree').reload();
        $("#step"+(step-1)).hide();
        $("#step"+step).show();
    });
    $('#back').click(function(){
        if(step<=1)return;
        $("#step"+step).hide();
        step--;
        $("#step"+step).show();
        $('#step').html(step);
    });
	//cari
	$("#cari-step1").change(function(){
		var t = $('#dimensi-step1').val();
		var nilai= $("#cari-step1").val();
		nilai = nilai.toLowerCase();
		$("#tree"+t+"-step1").dynatree("getRoot").visit(function(node){
			var n = node.data.title;
			n = n.toLowerCase();
			var pos = n.search(nilai);
			if(pos!=-1){
				node.expand(true);
				node.activate();
			}
		});
	});
	$("#cari-step2").change(function(){
		var t = $('#dimensi-step2').val();
		var nilai= $("#cari-step2").val();
		nilai = nilai.toLowerCase();
		$("#tree"+t+"-step2").dynatree("getRoot").visit(function(node){
			var n = node.data.title;
			n = n.toLowerCase();
			var pos = n.search(nilai);
			if(pos!=-1){
				node.expand(true);
				node.focus();
				node.activate();
			}
		});
	});
	$("#cari-step3").change(function(){
		var t = $('#dimensi-step3').val();
		var nilai= $("#cari-step3").val();
		nilai = nilai.toLowerCase();
		$("#tree"+t+"-step3").dynatree("getRoot").visit(function(node){
			var n = node.data.title;
			n = n.toLowerCase();
			var pos = n.search(nilai);
			if(pos!=-1){
				node.expand(true);
				node.focus();
				node.activate();
			}
		});
	});
});
