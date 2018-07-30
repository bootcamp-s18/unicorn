<template>

    <div>

        <div class="form-group">
            <label for="searchBox" class="font-weight-bold">Filter Contacts:</label>
            <input id="searchBox" class="form-control" type="text" v-model="searchString" placeholder="Search by name..." />
            <button class="btn btn-primary" type="button">Create/ Edit Contact</button> 
            <button class="btn btn-warning" type="button">Import</button>
            <button class="btn btn-success" type="button">Export</button>
            <button class="btn btn-danger" type="button">Delete</button>
            <input class="ml-3 my-auto" type="checkbox" name="selectAll" value="selectAll">
        </div>

        <ul class="list-unstyled">
            <li class="media my-4" v-for="contact in filteredContacts">
                <img class="mr-3" src="" alt="" style="height:128px;">
                <div class="media-body">
                    <h5 class="mt-0 mb-1">{{ contact.first_name +' '+contact.last_name }}<small class="justify-content-right"><i>Created on {{ contact.updated_at }}</i></small></h5>
                    
                </div>
                <div class="row">
                    <div class="col-xs-auto">
                        <button class="btn btn-sm"><a href="/editContact"><i class="fas fa-pencil-alt text-info"></i></a></button>
                    </div>
                    <div class="col-xs-auto">
                        <form method="post" :action="'/contact/' + contact.id">
                            <input type="hidden" name="_token" :value="csrf">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-sm" type="submit"><i class="far fa-trash-alt text-danger"></i></button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
            
        props: ['contactsData'],
        data: () => ({
            searchString: '',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }),      
        mounted() {
            console.log('Component mounted.')
        },
        computed: {
            filteredContacts: function() {
                var contacts_array = this.contactsData;
                var search_string = this.searchString.toLowerCase();
                if (!search_string) {
                    return contacts_array;
                }
                contacts_array = contacts_array.filter(function(item) {
                    if(item.name.toLowerCase().indexOf(search_string) !== -1) {
                        return item;
                    }
                });
                return contacts_array;
            }
        }
    }
</script>
