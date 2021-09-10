$().ready(() => {

    colorStatus($('.status'));

    $('.sign-in').click(function (e){
        e.preventDefault()
        const login = $('#login').val()
        const password = $('#password').val()
        $.ajax({
            url: 'login',
            method: 'post',
            dataType: 'html',
            data: {
                login,
                password,
            },
            success: function(data){
                let newDoc = document.open("text/html", "replace");
                newDoc.write(data);
                newDoc.close();
            }
        });
    })

    $('.sign-out').click(function (e) {
        e.preventDefault()
        $.ajax({
            url: 'logout',
            method: 'post',
            dataType: 'html',
            data: {
                logout: true,
            },
            success: function (data) {
                let newDoc = document.open("text/html", "replace");
                newDoc.write(data);
                newDoc.close();
            }
        });
    })

    $('.save-btn').click(function (e) {
        e.preventDefault()
        const new_text = $(this).parent('.description').children('textarea').val()
        const task_id = $(this).parent('.description').data('id')
        const status = $('body').find('select[data-id='+ task_id +']').val()

        $.ajax({
            url: 'update_task',
            method: 'post',
            dataType: 'html',
            data: {
                task_id,
                status,
                description: new_text
            },
            success: function (data) {
                let newDoc = document.open("text/html", "replace");
                newDoc.write(data);
                newDoc.close();
            }
        });
    })

    $('#add').submit(function (e) {
        e.preventDefault()
        let form_data = $(this).serialize()
        $.ajax({
            url: 'add_task',
            method: 'post',
            dataType: 'html',
            data: form_data,
            success: function (data) {
                let newDoc = document.open("text/html", "replace");
                newDoc.write(data);
                newDoc.close();
            }
        })
    })

    $('.pagination input').click(function () {
        let page_namber = $(this).val()
        $.ajax({
            url: '/',
            method: 'get',
            dataType: 'html',
            data: {
                page: page_namber
            },
            success: function (data) {
                let newDoc = document.open("text/html", "replace");
                newDoc.write(data);
                newDoc.close();
                history.pushState({page: page_namber}, '', '/?page='+page_namber)
            }
        })
    })
})

colorStatus = (obj) => {
    obj.each(function() {
        let val = $(this).text()
        switch (val) {
            case 'not in work':
                $(this).css('color', 'red')
                break
            case 'in work':
                $(this).css('color', 'blue')
                break
            case 'done':
                $(this).css('color', 'darkgreen')
                break
            default:
        }
    })

}