<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="smsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa-solid fa-sms"></i>
    </a>
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="smsDropdown">
        <h6 class="dropdown-header d-flex justify-content-between align-items-center">
            <span>SMS Notification Center</span>
            <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#sendSmsModal">Send SMS</button>
        </h6>
    </div>
</li>

<div class="modal fade" id="sendSmsModal" tabindex="-1" aria-labelledby="sendSmsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendSmsModalLabel">Send SMS Notification</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form id="sendSmsForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="grantor" class="form-label text-secondary fw-semibold">Scholars From...</label>
                        <select id="grantor" name="grantor" class="form-control" required>
                            <option value="" disabled selected>Select Scholarship Program</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="contact_no" class="form-label text-secondary fw-semibold">Contact Numbers</label>
                        <div id="contact_list" class="contact-list border rounded p-2"></div>
                        <div class="mt-2">
                            <input type="checkbox" id="select_all" onclick="toggleSelectAll(this)">
                            <label for="select_all" class="form-label">Select All</label>
                        </div>
                    </div>
                    <style>
                        .contact-list {
                            max-height: 200px;
                            overflow-y: auto;
                            padding: 10px;
                            border: 1px solid #ccc;
                            border-radius: 5px;
                            background-color: #f9f9f9;
                        }
                    </style>
                    <div class="mb-3">
                        <label for="smsMessage" class="form-label">Message</label>
                        <textarea class="form-control" name="smsMessage" id="smsMessage" rows="4" placeholder="Type your message here..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="sendSmsButton">
                        <i class="fas fa-paper-plane"></i> Send SMS
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirm SMS Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Scholarship Program:</strong> <span id="confirmGrantor"></span></p>
                <p><strong>Message:</strong> <span id="confirmMessage"></span></p>
                <p><strong>Phone Numbers:</strong> <span id="confirmContacts"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancelSend" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmSend">Send SMS</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const validPhoneRegex = /^(\+639|09|9)\d{9}$/; // Philippine phone number pattern
        const processedNumbers = new Set(); // To track unique normalized phone numbers

        /**
         * Normalize a phone number to the standard 09XXXXXXXXX format.
         * @param {string} phoneNumber - The phone number to normalize.
         * @returns {string|null} - The normalized phone number or null if invalid.
         */
        const normalizePhoneNumber = (phoneNumber) => {
            if (/^9\d{9}$/.test(phoneNumber)) {
                return `09${phoneNumber}`;
            }
            if (/^\+639\d{9}$/.test(phoneNumber)) {
                return `0${phoneNumber.slice(3)}`;
            }
            if (/^09\d{9}$/.test(phoneNumber)) {
                return phoneNumber;
            }
            return null; // Invalid format
        };

        // Example usage
        console.log(normalizePhoneNumber("9123456789")); // Outputs: 091
        const contactList = document.getElementById("contact_list");
        const selectAllCheckbox = document.getElementById("select_all");

        fetch("fetch_data.php")
            .then((response) => response.json())
            .then((data) => {
                const grantorDropdown = document.getElementById("grantor");
                data.scholarships.forEach((item) => {
                    const option = document.createElement("option");
                    option.value = item.id;
                    option.textContent = item.grantor;
                    grantorDropdown.appendChild(option);
                });

                // Sort contacts by fullname alphabetically
                const sortedContacts = data.contacts.sort((a, b) =>
                    a.fullname.localeCompare(b.fullname, undefined, {
                        sensitivity: "base"
                    })
                );

                sortedContacts.forEach((contact) => {
                    const normalizedPhone = normalizePhoneNumber(contact.contact_no);

                    // Validate and avoid duplicates
                    if (normalizedPhone && validPhoneRegex.test(normalizedPhone) && !processedNumbers.has(normalizedPhone)) {
                        processedNumbers.add(normalizedPhone);

                        const checkboxWrapper = document.createElement("div");
                        checkboxWrapper.classList.add("form-check", "mb-2");

                        const checkbox = document.createElement("input");
                        checkbox.type = "checkbox";
                        checkbox.className = "form-check-input contact-checkbox";
                        checkbox.id = `contact_${normalizedPhone}`;
                        checkbox.name = "contact_no[]";
                        checkbox.value = normalizedPhone;

                        const label = document.createElement("label");
                        label.className = "form-check-label";
                        label.htmlFor = `contact_${normalizedPhone}`;
                        label.textContent = `${contact.fullname} - ${normalizedPhone}`;

                        checkboxWrapper.appendChild(checkbox);
                        checkboxWrapper.appendChild(label);
                        contactList.appendChild(checkboxWrapper);
                    }
                });
                // Show warning if no valid contacts found
                if (processedNumbers.size === 0) {
                    contactList.innerHTML = "<p class='text-danger'>No valid contacts found.</p>";
                }
            })
            .catch((error) => console.error("Error fetching data:", error));

        const sendSmsForm = document.getElementById("sendSmsForm");
        const confirmationModal = document.getElementById("confirmationModal");
        const confirmButton = document.getElementById("confirmSend");

        sendSmsForm.addEventListener("submit", function(event) {
            event.preventDefault();

            const grantorDropdown = document.getElementById("grantor");
            const message = document.getElementById("smsMessage").value;

            const grantorText =
                grantorDropdown.options[grantorDropdown.selectedIndex]?.textContent || "";
            const selectedContacts = Array.from(
                document.querySelectorAll(".contact-checkbox:checked")
            ).map((checkbox) => checkbox.value);

            if (!grantorText || !message || selectedContacts.length === 0) {
                alert("Please fill in all the fields and select at least one contact.");
                return;
            }

            document.getElementById("confirmGrantor").textContent = grantorText;
            document.getElementById("confirmMessage").textContent = message;
            document.getElementById("confirmContacts").textContent = selectedContacts.join(", ");
            $(confirmationModal).modal("show");

            confirmButton.onclick = () => {
                $(confirmationModal).modal("hide");

                fetch("process_sms.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            message: message,
                            contacts: selectedContacts,
                        }),
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        console.log("Backend response:", data);
                        if (data.success) {
                            alert("SMS successfully sent!");
                            sendSmsForm.reset();
                            document.querySelectorAll(".contact-checkbox").forEach((checkbox) => (checkbox.checked = false));
                            document.getElementById("select_all").checked = false;
                        } else {
                            alert("Failed to send SMS: " + data.message);
                        }
                    })
                    .catch((error) => console.error("Error sending SMS:", error));

            };
        });

        // Prevent recursive event triggering
        let isHandlingEvent = false;

        selectAllCheckbox.addEventListener("change", function() {
            if (isHandlingEvent) return; // Prevent re-entry
            isHandlingEvent = true;

            const contactCheckboxes = document.querySelectorAll(".contact-checkbox");
            contactCheckboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });

            isHandlingEvent = false;
        });

        contactList.addEventListener("change", (event) => {
            if (isHandlingEvent) return; // Prevent re-entry
            if (event.target.classList.contains("contact-checkbox")) {
                isHandlingEvent = true;

                const allCheckboxes = document.querySelectorAll(".contact-checkbox");
                const allChecked = Array.from(allCheckboxes).every((checkbox) => checkbox.checked);
                const anyChecked = Array.from(allCheckboxes).some((checkbox) => checkbox.checked);

                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = !allChecked && anyChecked;

                isHandlingEvent = false;
            }
        });
    });
</script>