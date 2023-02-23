<!-- Select2 -->
<script>
    $(document).ready(function() {
        function html(services) {
            let html = '';
            let html_option = '';
            for (let x in services) {
                html += `
                <a href="javascript:void(0)" class="service-item item-list" data-name="${services[x].name}" data-id="${services[x].id}">
                    <img src="{{asset('storage/`+ services[x].image +`')}}">
                    <span>${services[x].name}</span>
                </a>`;
            }
            return html;
        };

        function htmlType(service_types) {
            let html = '';
            let html_option = '';
            for (let x in service_types) {
                for(let i in service_types[x].service_charge) {
                    html_option += `<option value="${service_types[x].service_charge[i].id}">${service_types[x].service_charge[i].price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'})} / ${service_types[x].service_charge[i].month} tháng</option>`;
                };
                html += `<div class="col-4 service-type-item">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img class="image-service" src="{{asset('storage/${service_types[x].service_image}')}}" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title" style="border-bottom: 2px solid red; margin-bottom:10px; float:none">${service_types[x].name}</h5>
                                    <div class="service-content">${service_types[x].description}</div>
                                    <select class="form-control service_charge_id" id="service_charge_id" name="service_charge_id">`+
                                        html_option
                                    +`</select>
                                    <div style="width:100%;" class="service-submit">
                                        <button style="width:100%; margin-top:20px" type="button" class="btn btn-primary btn-service-create">Đăng ký</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
                html_option = '';
            }
            return html;
        }

        $(document).on('click', '.service-group-item', function() {
            let service_group_id = $(this).data('id');
            let service_group_name = $(this).data('name');
            $.ajax({
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `{{route('ceo.hire.showService')}}`,
                data: {
                    service_group_id: service_group_id,
                },
                success: function(response) {
                    $('.select-service').removeClass('display-none');
                    $('.select-service span').text(service_group_name);
                    $('.service-list').html(html(response.services));
                },
                error: function(xhr) {}
            })
        });

        $(document).on('click', '.service-item', function() {
            let service_id = $(this).data('id');
            let service_name = $(this).data('name');
            $.ajax({
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `{{route('ceo.hire.showServiceType')}}`,
                data: {
                    service_id: service_id,
                },
                success: function(response) {
                    $('.select-type').removeClass('display-none');
                    $('.select-type span').text(service_name);
                    $('.service-type-list').html(htmlType(response.service_types));
                },
                error: function(xhr) {}
            })
        });

        $(document).on('click', '.btn-service-create', function() {
            let parent = $(this).closest('.service-type-item');
            let service_charge_id = parent.find('.service_charge_id').val();
            window.location = `/ceo/hire/create/` + service_charge_id;
        });

    })
</script>