function transfer(registro) {
    let proprietario = $("#select" + registro).val();
    let _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "GET",
        url: "http://localhost:8000/tarefas/owner/" + registro,
        data: {
            owner: proprietario,
            _token: _token,

        },
        beforeSend: function() {

        },
        success: function(data) {

            $(".return2").removeClass('displayNone');
            location.reload();
        },
        error: function() {

        }
    });
}

function sTransfer(registro) {
    let status = $("#selectstat" + registro).val();
    let _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "GET",
        url: "http://localhost:8000/tarefas/status/" + registro,
        data: {
            status: status,
            _token: _token,

        },
        beforeSend: function() {

        },
        success: function(data) {
            $(".return").removeClass('displayNone');
        },
        error: function() {

        }
    });
}

function reset() {
    $(".return").addClass('displayNone');

}

function showAlert(id) {
    Swal.fire({
        title: 'Tem Certeza?',
        text: "Essa ação não poderá ser revertida!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, Deletar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deletado!',
                'Essa tarefa foi removida com sucesso.',
                'success'
            )
            $('#tr' + id).addClass("displayNone");
            $('#delete' + id).submit();
        }
    })
}

function fMasc(objeto, mascara) {
    obj = objeto
    masc = mascara
    setTimeout("fMascEx()", 1)
}

function fMascEx() {
    obj.value = masc(obj.value)
}

function mTel(tel) {
    tel = tel.replace(/\D/g, "")
    tel = tel.replace(/^(\d)/, "($1")
    tel = tel.replace(/(.{3})(\d)/, "$1)$2")
    if (tel.length == 9) {
        tel = tel.replace(/(.{1})$/, "-$1")
    } else if (tel.length == 10) {
        tel = tel.replace(/(.{2})$/, "-$1")
    } else if (tel.length == 11) {
        tel = tel.replace(/(.{3})$/, "-$1")
    } else if (tel.length == 12) {
        tel = tel.replace(/(.{4})$/, "-$1")
    } else if (tel.length > 12) {
        tel = tel.replace(/(.{4})$/, "-$1")
    }
    return tel;
}

function mCNPJ(cnpj) {
    cnpj = cnpj.replace(/\D/g, "")
    cnpj = cnpj.replace(/^(\d{2})(\d)/, "$1.$2")
    cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3")
    cnpj = cnpj.replace(/\.(\d{3})(\d)/, ".$1/$2")
    cnpj = cnpj.replace(/(\d{4})(\d)/, "$1-$2")
    return cnpj
}

function mCPF(cpf) {
    cpf = cpf.replace(/\D/g, "")
    cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2")
    cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2")
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2")
    return cpf
}

function mCEP(cep) {
    cep = cep.replace(/\D/g, "")
    cep = cep.replace(/^(\d{2})(\d)/, "$1.$2")
    cep = cep.replace(/\.(\d{3})(\d)/, ".$1-$2")
    return cep
}

function mNum(num) {
    num = num.replace(/\D/g, "")
    return num
}

function setStatus(id, value) {
    $("#" + id).val(value);
}