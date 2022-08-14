export default () => ({
    daysOfWeek: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],

    datePickerOpen: false,

    showingYearSelector: false,

    init: function () {
        if (this.validDate == undefined)
            //Ensure that all dates are classified as valid
            this.validDate = function () { return false };

        this.showPrevYears = this.showPrevYears == undefined ? true : this.showPrevYears;
    },

    setDate: function (day) {
        const newDate = new Date();
        newDate.setDate(parseInt(day));
        newDate.setFullYear(this.viewDate.getFullYear());
        newDate.setMonth(this.viewDate.getMonth());

        if (!isNaN(newDate))
            this.selectedDate = newDate;
        this.datePickerOpen = false;

        //Bubble up the updated date so it is accessable outside the component
        //this.$dispatch('date-updated', this.selectedDate.getFullYear() + '-' + String(this.selectedDate.getMonth() + 1).padStart(2, '0') + '-' + String(this.selectedDate.getDate()).padStart(2, '0'));
    },

    setYear: function (year) {
        const newDate = new Date(this.viewDate.valueOf());
        newDate.setFullYear(year);

        if (!isNaN(newDate))
            this.viewDate = newDate;
        this.showingYearSelector = false;

    },

    prevMonth: function () {
        const newDate = new Date(this.viewDate.valueOf());
        newDate.setMonth(newDate.getMonth() - 1);
        this.viewDate = newDate;
    },

    nextMonth: function () {
        const newDate = new Date(this.viewDate.valueOf());
        newDate.setMonth(newDate.getMonth() + 1);
        this.viewDate = newDate;
    },

    isSelectedDate: function (day) {
        return this.viewDate.getFullYear() == this.selectedDate.getFullYear() && this.viewDate.getMonth() == this.selectedDate.getMonth() && day == this.selectedDate.getDate();
    },

    //Getters

    get formattedDate() {
        return (this.selectedDate.getMonth() + 1) + '/' + String(this.selectedDate.getDate()) + '/' + this.selectedDate.getFullYear();
    },

    get monthDays() {
        const month = this.viewDate.getMonth();

        return new Date(this.viewDate.getFullYear(), month + 1, 0).getDate();
    },

    get numberBlanks() {
        const firstDayOfMonth = new Date(this.viewDate.getFullYear(), this.viewDate.getMonth(), 1).getUTCDay();
        var blanks = 0;

        for (var i = 0; i < firstDayOfMonth; i++) {
            blanks += 1;
        }
        return blanks;
    },

    get monthYear() {
        return this.viewDate.toLocaleString('default', { month: 'long' }) + ' ' + this.viewDate.getFullYear();
    },

    get headerDateString() {
        return this.selectedDate.toLocaleString('default', { weekday: 'short' }) + ', ' + this.selectedDate.toLocaleString('default', { month: 'short' }) + ' ' + (this.selectedDate.getDate());
    },

    get year() {
        return this.selectedDate.getFullYear();
    },

    get yearsList() {
        const currentYear = new Date().getFullYear();

        const start = currentYear;
        if (this.showPrevYears)
            start = start - 25;
        const end = currentYear + 26;

        return Array.from({ length: end - start }, (v, k) => k + start);
    }

})