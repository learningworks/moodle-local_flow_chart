function addReloadClass(num) {
	$('#id_s_local_flow_chart_num_questions').attr('class', 'reload');

	for (var i = 1; i <= num; i++) {
		$('#id_s_local_flow_chart_question_type_' + i).attr('class', 'reload');
	}
}

function attachReloadHandler() {
	$('#adminsettings select.reload').each(function() {
		$(this).change(function() {
			$(".form-submit").click();
		})
	});
}

function buildQuestion(data, num) {
	console.log(data);
	console.log(num);

	var isBranch = false, isLeaf = false;

	if (data['type'] == 'Branch') {
		isBranch = true;
	} else if (data['type'] == 'Leaf') {
		isLeaf = true;
	}
	else {
		console.log("invalid question type");
		return;
	}


	if (isBranch) {
		var container = document.createElement('div');

		var label_q = document.createElement('label');
		label_q.setAttribute('class', 'question');
		label_q.innerHTML = 'Q' + num + '. ' + data['question'];

		var div_1 = document.createElement("div");
		div_1.setAttribute('class', 'answer_box');

		var label_a1 = document.createElement('label');
		label_a1.setAttribute('class', 'answer');
		label_a1.setAttribute('for', 'question_' + num + '_ans_1');
		label_a1.textContent = data['answer_1'];
		
		var input_a1 = document.createElement('input');
		input_a1.setAttribute('type', 'radio');
		input_a1.setAttribute('name', 'question_' + num);
		input_a1.setAttribute('id', 'question_' + num + '_ans_1');
		input_a1.setAttribute('class', 'radio');
		input_a1.setAttribute('value', num + ' ' + data['link_1']);

		var div_2 = document.createElement("div");
		div_2.setAttribute('class', 'answer_box');

		var label_a2 = document.createElement('label');
		label_a2.setAttribute('class', 'answer');
		label_a2.setAttribute('for', 'question_' + num + '_ans_2');
		label_a2.textContent = data['answer_2'];

		var input_a2 = document.createElement('input');
		input_a2.setAttribute('class', 'radio');
		input_a2.setAttribute('type', 'radio');
		input_a2.setAttribute('name', 'question_' + num);
		input_a2.setAttribute('id', 'question_' + num + '_ans_2');

		input_a2.setAttribute('class', 'radio');
		input_a2.setAttribute('value', num + ' ' + data['link_2']);

		var fieldset;
		var responce_1, responce_2;


		fieldset = document.createElement('fieldset');
		fieldset.setAttribute('class', 'flow_chart-question');
		fieldset.setAttribute('id', 'question_' + (num+1));

		div_1.appendChild(label_a1);
		div_1.appendChild(input_a1);
		div_2.appendChild(label_a2);
		div_2.appendChild(input_a2);

		container.appendChild(label_q);
		container.appendChild(div_1);
		container.appendChild(div_2);

		container.appendChild(fieldset);

		$('form #question_' + num).html(container);

		// Inbind old event handlers to prevent stacking.
		$('input.radio').unbind('change');

		// Bind new handlers.
		$('input.radio').change(function() {
			nextQuestion($(this));
		});

	} else if (isLeaf) {
		var responce;

		responce = document.createElement('div');
		responce.setAttribute('id', 'responce');
		responce.setAttribute('class', 'responce');
		responce.innerHTML = data['responce'];

		//container.appendChild(responce);

		$('form #question_' + num).html(responce);

		// Bind new handlers.
		$('form .leaf').change(function() {
			console.log('1');
			quizComplete($(this));
			console.log('2');
		});
	}
	else {
		console.log("invalid question type")
	}
}

function nextQuestion(input) {
	input = input.val().split(' ');
	console.log(input);

	var ajaxData = {
		'question': input[1], // next question.
	}

	$.post('./next_question.php', ajaxData, function(data) {
		data = JSON.parse(data);

	// Remove the <p> tags from the question.
	data['question'] = $(data['question']).text(); // TODO: change. 

		buildQuestion(data, Number(input[0]) + 1); // display num.
	})
	.fail(function() {
		console.log('fail');
	});
}

var firstInput = document.createElement('input');
firstInput.setAttribute('value', '0 1');

nextQuestion($(firstInput));