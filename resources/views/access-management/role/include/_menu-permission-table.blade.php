<table class="table table-hover" width="100%" id="table-menu-permission">
    <thead>
        <tr>
            <th width="30%" scope="col">{{ __('Menu Name') }}</th>
            <th width="70%" scope="col">{{ __('Menu Permissions') }}</th>
        </tr>
    </thead>
    <tbody>{!! Menu::renderMenuPermissionTable($menus) !!}</tbody>
</table>

@push('page_script')
<script>
    const tableMenuPermisson = $('#table-menu-permission');
    $(document).ready(function () {
        tableMenuPermisson.on('click', '.menu-checkbox', function(e){
            checkMenu($(this));
        });

        tableMenuPermisson.on('click', '.permission-checkbox', function(e){
            checkPermission($(this));
        });

        @if(isset($grantedMenus))
        const grantedMenus = {!! json_encode($grantedMenus) !!};
        const checkedMenuElements = grantedMenus.map(function(item){
            return '#menu-'+item;
        }).join(',');
        $(checkedMenuElements).prop('checked', true);
        @endif

        @if(isset($grantedPermissions))
        const grantedPermissions = {!! json_encode($grantedPermissions) !!};
        const checkedPermissionElements = grantedPermissions.map(function(item){
            return '#permission-'+item;
        }).join(',');
        $(checkedPermissionElements).prop('checked', true);
        @endif
    });

    function checkMenu(menuCheckbox, onlyParent = false) {
        const isChecked = menuCheckbox.is(':checked');
        const menuId = menuCheckbox.val();
        const data = menuCheckbox.data();
        const checkedChildCount = tableMenuPermisson.find('.menu-checkbox[data-parent_id="'+data.parent_id+'"]:checked').length;

        if(!onlyParent){
            //child check
            tableMenuPermisson.find('.menu-checkbox[data-parent_id="'+menuId+'"]').each(function(e){
                const childChecked = $(this).is(':checked');
                $(this).prop("checked",!isChecked);
                $(this).click();
            });
        }

        parentCheck(menuCheckbox);

        tableMenuPermisson.find('.permission-checkbox[data-menu_id="'+menuId+'"]').each(function(e){
            $(this).prop("checked",!isChecked);
            $(this).click();
        });

    }

    function parentCheck(menuCheckbox) {
        const isChecked = menuCheckbox.is(':checked');
        const menuId = menuCheckbox.val();
        const data = menuCheckbox.data();
        const checkedChildCount = tableMenuPermisson.find('.menu-checkbox[data-parent_id="'+data.parent_id+'"]:checked').length;

        //for parents check
        if (checkedChildCount > 0 && isChecked) {
            tableMenuPermisson.find('.menu-checkbox[data-id="'+data.parent_id+'"]').each(function(e){
                if(!$(this).is(":checked")){
                    $(this).prop("checked",true);
                    checkMenu($(this),true);
                }
            });
        }

        if(checkedChildCount == 0 && !isChecked) {
            tableMenuPermisson.find('.menu-checkbox[data-id="'+data.parent_id+'"]').each(function(e){
                if($(this).is(":checked")){
                    $(this).prop("checked",false);
                    checkMenu($(this),true);
                }
            });
        }
    }

    function checkPermission(permissionCheckbox) {
        const data = permissionCheckbox.data();
        const menuPermissionCheckedCount = tableMenuPermisson.find('.permission-checkbox[data-menu_id="'+data.menu_id+'"]:checked').length;
        const isChecked = permissionCheckbox.is(':checked');

        const menuCheckbox = tableMenuPermisson.find('.menu-checkbox[data-id="'+data.menu_id+'"]');
        const isMenuChecked = menuCheckbox.is(':checked');
        if (menuPermissionCheckedCount > 0 && !isMenuChecked) {
            menuCheckbox.prop('checked', true);
        }
        if (menuPermissionCheckedCount == 0 && isMenuChecked) {
            menuCheckbox.prop('checked', false);
        }
        parentCheck(menuCheckbox);
    }

    function getCheckedMenus() {
        let result = [];
        tableMenuPermisson.find('.menu-checkbox:checked').each(function(e){
            result.push($(this).val());
        });
        return result;
    }

    function getCheckedPermissions() {
        let result = [];
        tableMenuPermisson.find('.permission-checkbox:checked').each(function(e){
            result.push($(this).val());
        });
        return result;
    }

</script>
@endpush
