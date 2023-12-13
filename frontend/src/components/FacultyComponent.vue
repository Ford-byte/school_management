<template>
    <div class="container" style="max-height:580px; overflow-y: auto;">

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createFacultyModal"
            style="margin: 20px 30px;">
            Create New
        </button>

        <!-- Modal -->
        <div class="modal fade" id="createFacultyModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="max-height:550px; overflow-y: auto;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create New Faculty</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="submitData" class="my-3">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="profile" class="form-label">Profile Picture:</label>
                                <input type="file" @change="handleFileChange" class="form-control" accept="image/*" />
                            </div>
                            <div class="mb-3">
                                <label for="fname" class="form-label">First Name:</label>
                                <input type="text" v-model="fname" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label for="lname" class="form-label">Last Name:</label>
                                <input type="text" v-model="lname" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" v-model="email" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">password:</label>
                                <input type="password" v-model="password" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label for="dob" class="form-label">Date of Birth:</label>
                                <input type="date" v-model="dob" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label for="department" class="form-label">Department ID:</label>
                                <select v-model="departmentId" class="form-control" required>
                                    <option value="" disabled>Select Department</option>
                                    <option value="0">BEED</option>
                                    <option value="1">BSIT</option>
                                    <option value="2">BSHM</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="position" class="form-label">Position:</label>
                                <input type="text" v-model="position" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address:</label>
                                <input type="text" v-model="address" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number:</label>
                                <input type="tel" v-model="phoneNumber" class="form-control" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-4" v-for="response in responseData" :key="response.FacultyID">
                <div class="card">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-three-dots mx-3 dot" viewBox="0 0 16 16">
                        <path
                            d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
                    </svg>

                    <img style="width: 110px; height: 110px; border-radius: 50%; border: 1px solid gray;"
                        :src="'/src/assets/uploads/' + response.Profile" class="card-img-top mx-auto" alt="Profile Image">

                    <div class="card-body">
                        <h5 class="card-title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{
                            response.FirstName }} {{ response.LastName }}</h5>
                        <small class="card-text">{{ response.Email }}</small>
                        <p class="card-text">Male</p>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Role
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li @click="selectedRole = 'faculty'"><a class="dropdown-item" href="#">Manage
                                        Faculty</a></li>
                                <li @click="selectedRole = 'students'"><a class="dropdown-item" href="#">Manage
                                        Student</a></li>
                                <li @click="selectedRole = 'revoke'"><a class="dropdown-item" href="#">Revoke Management
                                        Access</a></li>
                            </ul>
                            <button class="btn btn-primary m-2" type="button" @click="save(response)">
                                Save
                            </button>
                            <!-- Edit -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil-square edit" viewBox="0 0 16 16" data-bs-toggle="modal"
                                :data-bs-target="`#editFacultyModal${response.FacultyID}`" @click="setData(response)">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>

                            <div class="modal fade" :id="`editFacultyModal${response.FacultyID}`" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="max-height:550px; overflow-y: auto;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Faculty {{
                                                response.FacultyID }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form @submit.prevent="editData(response.FacultyID)" class="my-3">
                                            <div class="modal-body " style="text-align: left;">
                                                <div class="mb-3 ">
                                                    <label for="profile" class="form-label ">Profile Picture:</label>
                                                    <input type="file" @change="handleFileChange" class="form-control"
                                                        accept="image/*" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="fname" class="form-label">First Name:</label>
                                                    <input type="text" v-model="fnameEdit" class="form-control" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="lname" class="form-label">Last Name:</label>
                                                    <input type="text" v-model="lnameEdit" class="form-control" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email:</label>
                                                    <input type="email" v-model="emailEdit" class="form-control" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">password:</label>
                                                    <input type="password" v-model="passwordEdit" class="form-control"
                                                        required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="dob" class="form-label">Date of Birth:</label>
                                                    <input type="date" v-model="dobEdit" class="form-control" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="department" class="form-label">Department ID:</label>
                                                    <select v-model="departIdEdit" class="form-control" required>
                                                        <option value="" disabled>Select Department</option>
                                                        <option value="0">BEED</option>
                                                        <option value="1">BSIT</option>
                                                        <option value="2">BSHM</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="position" class="form-label">Position:</label>
                                                    <input type="text" v-model="posEdit" class="form-control" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Address:</label>
                                                    <input type="text" v-model="addressEdit" class="form-control"
                                                        required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Phone Number:</label>
                                                    <input type="tel" v-model="cpNumberEdit" class="form-control"
                                                        required />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    Save changes
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                            <!-- delete -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-trash-fill trash" viewBox="0 0 16 16" data-bs-toggle="modal"
                                v-bind:data-bs-target="`#delFacultyModal${response.FacultyID}`">
                                <path
                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                            </svg>

                            <div class="modal fade" v-bind:id="`delFacultyModal${response.FacultyID}`" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Delete Item {{ response.FacultyID }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form @submit.prevent="deleteData(response.FacultyID)" class="my-3">
                                            <div class="modal-body">
                                                Are you sure you want to delete?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    Save changes
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script setup>
import { ref, onMounted } from 'vue';

const selectedRole = ref('');


const save = async (data) => {
    console.log(selectedRole.value);
    if (selectedRole.value === '') {
        alert('none selected');
        return;
    }
    else if (selectedRole.value !== 'revoke') {
        const privilageData = {
            selectedRole: selectedRole.value,
            privilageID: data.FacultyID,
            privilageEmail: data.Email,
            privilagePassword: data.Password
        };
        console.log()
        try {
            const response = await fetch('http://localhost/management/backend/Router/facultyRoute.php?action=savePrivilage', {
                method: 'POST',
                body: JSON.stringify(privilageData),
            });

            const responseData = await response.json();

            if (response.ok) {
                responseMessage.value = responseData.message;
                alert('Success: Data inserted successfully.');
            } else {
                responseMessage.value = responseData.error;
                alert('Error: ' + responseData.error);
            }
        } catch (error) {
            responseMessage.value = 'Error: ' + error.message;
            alert('Error: ' + error.message);
        }
    } else if (selectedRole.value === 'revoke') {
        const privilageData = {
            privilageID: data.FacultyID,
        };
        
        try {
            const response = await fetch('http://localhost/management/backend/Router/facultyRoute.php?action=revokePrivilage', {
                method: 'POST',
                body: privilageData,
            });

            const responseData = await response.json();

            if (response.ok) {
                responseMessage.value = responseData.message;
                alert('Success: Data Deleted successfully.');
            } else {
                responseMessage.value = responseData.error;
                alert('Error: ' + responseData.error);
            }
        } catch (error) {
            responseMessage.value = 'Error: ' + error.message;
            // alert('Error: ' + error.message);
        }

    }
};


const responseMessage = ref('');
const fname = ref('');
const lname = ref('');
const email = ref('');
const password = ref('');
const dob = ref('');
const departmentId = ref('');
const position = ref('');
const address = ref('');
const phoneNumber = ref('');
const profile = ref(null);

const handleFileChange = (event) => {
    profile.value = event.target.files[0];
};

const submitData = async () => {
    const dataToSend = new FormData();
    dataToSend.append('profile', profile.value);
    dataToSend.append('fname', fname.value);
    dataToSend.append('lname', lname.value);
    dataToSend.append('email', email.value);
    dataToSend.append('password', password.value);
    dataToSend.append('dob', dob.value);
    dataToSend.append('departmentId', departmentId.value);
    dataToSend.append('position', position.value);
    dataToSend.append('address', address.value);
    dataToSend.append('phoneNumber', phoneNumber.value);

    try {
        const response = await fetch('http://localhost/management/backend/Router/facultyRoute.php?action=create', {
            method: 'POST',
            body: dataToSend,
        });

        const data = await response.json();
        responseMessage.value = data;
        fetchdata(); // Assuming you have a fetchdata function to update the displayed data
        fname.value = '';
        lname.value = '';
        email.value = '';
        password.value = '';
        dob.value = '';
        departmentId.value = '';
        position.value = '';
        address.value = '';
        phoneNumber.value = '';
        profile.value = null;
    } catch (error) {
        responseMessage.value = 'Error: ' + error.message;
    }
    $('#createFacultyModal').modal('hide');
};

// update
const fnameEdit = ref('');
const lnameEdit = ref('');
const emailEdit = ref('');
const passwordEdit = ref('');
const dobEdit = ref('');
const departIdEdit = ref('');
const posEdit = ref('');
const addressEdit = ref('');
const cpNumberEdit = ref('');

const setData = (data) => {
    console.log("edit: " + data);

    fnameEdit.value = data.FirstName;
    lnameEdit.value = data.LastName;
    emailEdit.value = data.Email;
    passwordEdit.value = data.Password;
    dobEdit.value = data.DateOfBirth;
    departIdEdit.value = data.DepartmentID;
    posEdit.value = data.Position;
    addressEdit.value = data.Address;
    cpNumberEdit.value = data.PhoneNumber;
};

const editData = async (id) => {
    console.log("id:" + id);
    const dataUpdate = new FormData();
    dataUpdate.append('id', id);
    dataUpdate.append('profile', profile.value);
    dataUpdate.append('fnameEdit', fnameEdit.value);
    dataUpdate.append('lnameEdit', lnameEdit.value);
    dataUpdate.append('emailEdit', emailEdit.value);
    dataUpdate.append('passwordEdit', passwordEdit.value);
    dataUpdate.append('dobEdit', dobEdit.value);
    dataUpdate.append('departIdEdit', departIdEdit.value);
    dataUpdate.append('posEdit', posEdit.value);
    dataUpdate.append('addressEdit', addressEdit.value);
    dataUpdate.append('cpNumberEdit', cpNumberEdit.value);

    try {
        const response = await fetch('http://localhost/management/backend/Router/facultyRoute.php?action=update', {
            method: 'POST',
            body: dataUpdate,
        });
        const data = await response.json();
        responseMessage.value = data;
        fetchdata();

        $(`#editFacultyModal${id}`).modal('hide');
    } catch (error) {
        responseMessage.value = 'Error: ' + error.message;
    }
};

const deleteData = async (id) => {
    try {
        const response = await fetch('http://localhost/management/backend/Router/facultyRoute.php?action=delete', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(id),
        });
        const data = await response.json();
        responseMessage.value = data;
        fetchdata();
        $(`#delFacultyModal${id}`).modal('hide');
    } catch (error) {
        responseMessage.value = 'Error: ' + error.message;
    }
};
const responseData = ref([]);
const fetchdata = async () => {
    try {
        const response = await fetch('http://localhost/management/backend/Router/facultyRoute.php?action=getAll');
        const data = await response.json();
        responseData.value = data;
        console.log(responseData.value);
    } catch (error) {
        responseMessage.value = 'Error: ' + error.message;
    }
};


onMounted(async () => {
    await fetchdata();
    $('.dropdown-item').on('click', function () {
        var selectedText = $(this).text();
        $(this).closest('.dropdown').find('.btn-outline-primary').text(selectedText);
    });
});

</script>

<style scoped>
.card {
    width: 17rem;
    border: 1px solid #ccc;
    border-radius: 10px;
    margin-inline: auto;
    margin-top: 10px;
    padding-top: 25px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}



.dot:hover,
.edit:hover {
    color: blue;
}

.trash:hover {
    color: red;
}


.card-body {
    text-align: center;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}
</style>