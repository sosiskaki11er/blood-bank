import React, { useEffect, useState } from 'react'
import PLusIcon from '../assets/icons/plus.svg'
import { Socket } from '..'
import Appointment from './Appointment'

function Appointments({handleSubpage,subpage,role}) {
    console.log(role)
    const user = JSON.parse(localStorage.getItem("user"))
    const [appointments, setAppointments] = useState([])

    useEffect(() =>{
        setTimeout(() => {
            switch(role){
                case "donor":
                    Socket.request("GET",role,"transfusion/index",`:${user.token}`)
                    .then(data => setAppointments(data.data))
                    break;
                case "patient":
                    Socket.request("GET",role,"infusion/index",`:${user.token}`)
                    .then(data => {setAppointments(data.data);console.log(data.data)})
                    break;
                case "doctor":
                    Socket.request("GET",role,"infusion/index",`:${user.data.token}`)
                    .then(data => {setAppointments(data.data);console.log(data.data)})
                    break;
                case "staff":
                    Socket.request("GET",role,"transfusionsIndex",`:${user.token}`)
                    .then(data => {setAppointments(data.data);console.log(data.data)})
                    break;
            }
            
        },100)
    },[])

    const compareDates = (a, b) => {
        const dateA = new Date(a.date);
        const dateB = new Date(b.date);
      
        return dateA - dateB;
    };
  return (
    <div className='component'>
        <h3>Upcoming appointments</h3>
        <div className='container gap-[20px] flex-wrap'>

            {
                (subpage === 'home' && role==="donor") && 
                <>
                    {appointments.length!=0 && <Appointment handleSubpage={handleSubpage} appointment={appointments.filter(appointment => appointment.donor_guid === user.data.guid).sort(compareDates)[0]}/>}
                    <div 
                        className='add-tab'
                        onClick={() => handleSubpage('schedule')}
                        >
                            <img src={PLusIcon}/>
                            <h3>Schedule appointment </h3>
                    </div>
                </>
                
            }

            {
                (subpage !== "home" && role==="donor") &&
                <>
                    {
                    appointments.filter(appointment => appointment.donor_guid === user.data.guid).sort(compareDates).map(appointment => <Appointment appointment={appointment}/>)
                    }
                </> 
            }

            {
                (subpage === 'home' && role==="patient") && 
                <>
                    <Appointment handleSubpage={handleSubpage} appointment={appointments.filter(appointment => appointment.patient_guid === user.patient.guid).sort(compareDates)[0]}/>
                    <div 
                        className='add-tab'
                        onClick={() => handleSubpage('schedule')}
                        >
                            <img src={PLusIcon}/>
                            <h3>Schedule appointment </h3>
                    </div>
                </>
                
            }

            {
                (subpage !== "home" && role==="patient") &&
                <>
                    {
                    appointments.filter(appointment => appointment.patient_guid === user.patient.guid).sort(compareDates).map(appointment => <Appointment appointment={appointment}/>)
                    }
                </> 
            }

            {
                (role === 'staff' && subpage!== "home") && 
                <>
                    {
                    appointments.filter(appointment => appointment.hospital_guid === user.staff.hospital_guid).map(appointment => <Appointment HandleSubpage={handleSubpage} role={role} appointment={appointment}/>)
                    }
                </>
            }

            {
                (role==='doctor' && subpage!== "home") && 
                <>
                    {
                    appointments.filter(appointment => appointment.doctor_guid === user.data.user.guid).map(appointment => <Appointment HandleSubpage={handleSubpage} role={role} appointment={appointment}/>)
                    }
                </>
            }
        </div>
    </div>
  )
}

export default Appointments