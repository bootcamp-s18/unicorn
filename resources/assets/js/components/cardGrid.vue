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
                <img class="mr-3" src="/images/img_avatar3.png" alt="" style="height:128px;">
                <div class="media-body">
                    <h5 class="mt-0 mb-1">{{ contact.first_name +' '+contact.last_name }}</h5>
                    <small class="text-right"><i>Created on {{ contact.updated_at }}</i></small>
                </div>
                
                <div class="row">
                    <div class="col-sm-auto">
                        <button class="btn btn-sm"><a href="/editContact"><i class="fas fa-pencil-alt text-info"></i></a></button>
                    </div>
                    <div class="col-sm-auto">
                        <form method="post" :action="'/contact/' + contact.id">
                            <input type="hidden" name="_token" :value="csrf">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-sm" type="submit"><i class="far fa-trash-alt text-danger"></i></button>
                        </form>
                    </div>
                </div>
                <div>
                <p v-if="contact.organization">Organization: {{ contact.organization }}</p>
                <p v-if="contact.work_phone">Work Phone: {{ contact.work_phone }}</p>
                <p v-if="contact.work_email">Work Email: {{ contact.work_email }}</p>
                <p v-if="contact.personal_email">Personal Email: {{ contact.personal_email }}</p>
                <p v-if="contact.cell_phone">Cell Phone: {{ contact.cell_phone }}</p>
                <p v-if="contact.home_phone">Home Phone: {{ contact.home_phone }}</p>
                <p v-if="contact.address">Address: {{ contact.address }}</p>
                <p v-if="contact.birthdate">Birthdate: {{ contact.birthdate }}</p>
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
                    if(item.last_name.toLowerCase().indexOf(search_string) !== -1) {
                        return item;
                    }
                });
                return contacts_array;
            }
        }
    }
</script>
