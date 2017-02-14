function sumValues(arr, type){
	var value = 0;
	
	arr.each(function(){
		value += Number($(this).attr('data-price'));
	});
	
	return value;
}

function convert_decimal(num){
	return Number(num.replace('.', '').replace(',','.'));
}

function updateValue(){
	//especialidades -> valor por hora
	var list_especialidade = $('#EspecialidadeEspecialidade option:selected');
	//despesas -> valores em real
	var list_despesas = $('#DespesaDespesa option:selected');
	// materiais -> valores em real
	var list_materiais = $('#OrcamentoMateriaisDistribuidores option:selected');
	
	var hora_normal = Number(document.getElementById('OrcamentoQtdHorasNormais').value);
	var hora_extra = Number(document.getElementById('OrcamentoQtdHorasExtra').value);
	var hora_noturna = Number(document.getElementById('OrcamentoQtdHorasNoturna').value);
	var retrabalho = convert_decimal(document.getElementById('OrcamentoFatorRetrabalho').value);
	var imposto = convert_decimal(document.getElementById('OrcamentoImposto').value);

	var horas = 0;

	if(hora_normal > 0)
		horas += hora_normal;
	if(hora_extra > 0)
	 	horas += (((hora_extra/100)*50) + hora_extra);

	if(hora_noturna > 0)
		horas += (((hora_noturna/100)*70) + hora_noturna);

	valor_especialidades = Number(sumValues(list_especialidade, 'especialidades'));
	valor_despesas = Number(sumValues(list_despesas, 'despesas'));
	valor_materiais = Number(sumValues(list_materiais, 'materiaisdistribuidores'));


	var valor_total = 0;
	
	if(valor_especialidades > 0)
		valor_total += valor_especialidades * horas;
	
	if(valor_materiais > 0)
		valor_total += valor_materiais;
	
	if(valor_despesas > 0)
		valor_total += valor_despesas;
	//calcula o fator de retrabalho
	if(retrabalho > 0)
		valor_total += (((valor_total/100)*retrabalho) + valor_total);
	//calcula o imposto
	if(imposto > 0)
		valor_total += (((valor_total/100)*imposto) + valor_total);
	valor_total = 
	$('#OrcamentoValor').val(valor_total.toFixed(2));

}

$(function(){
	$('#OrcamentoAdicionarForm').on('blur', 'input', function(){updateValue()});
	$('#OrcamentoAdicionarForm').on('click', '.ms-list li', function(){updateValue()});
});