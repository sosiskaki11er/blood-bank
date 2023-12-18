import React, { useEffect, useState } from 'react'
import PLusIcon from '../assets/icons/plus.svg'
import { Socket } from '..'
import Appointment from './Appointment'

function Appointments({handleSubpage,subpage,role}) {
    const user = JSON.parse(localStorage.getItem("user"))
    const [appointments, setAppointments] = useState([])

    useEffect(() =>{
        setTimeout(() => {
            switch(role){
                case "donor":
                    Socket.request("GET",role,"transfusion/index",`:${user.token}`)
                    .then(data => setAppointments(data.data))
                case "patient":
                    Socket.request("GET",role,"infusion/index",`:${user.token}`)
                    .then(data => setAppointments(data.data))
                case "doctor":
                    Socket.request("GET",role,"infusion/index",`:${user.data.token}`)
                    .then(data => {setAppointments(data.data);console.log(data.data)})
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
                (subpage === 'home' && (role==="donor" || role==="patient")) ? 
                <>
                    <Appointment appointment={appointments.filter(appointment => appointment.donor_guid === user.data.guid).sort(compareDates)[0]}/>
                    <div 
                        className='add-tab'
                        onClick={() => handleSubpage('schedule')}
                        >
                            <img src={PLusIcon}/>
                            <h3>Schedule appointment </h3>
                    </div>
                </>
                :
                
                appointments.filter(appointment => appointment.donor_guid === user.data.guid).sort(compareDates).map(appointment => <Appointment appointment={appointment}/>)
                
            }

            {
                (role==='doctor' || role === 'staff') && 
                <>
                <div className='card gap-[48px]'>
                <div className='my-auto'>
                    <h4 className='text-red-600'>October</h4>
                    <h1 className='text-[48px] leading-[48px] font-medium'>28</h1>
                </div>
                <div className='container gap-[24px]'>
                    <div className='container flex-col text-grey-700 my-auto gap-[12px]'>
                        <h3 className='text-base'>Status:</h3>
                        <h3 className='text-base'>Time:</h3>
                    </div>
                    <div className='container flex-col my-auto gap-[12px]'>
                        <div className='container gap-[8px]'>
                            <div className='indicator approve'/>
                            <h3 className='text-base'>Approved</h3>
                        </div>
                        <h3 className='text-base'>16:25</h3>
                    </div>
                </div>
            </div>
            <div className='card gap-[48px]'>
                <div className='my-auto'>
                    <h4 className='text-red-600'>October</h4>
                    <h1 className='text-[48px] leading-[48px] font-medium'>28</h1>
                </div>
                <div className='container gap-[24px]'>
                    <div className='container flex-col text-grey-700 my-auto gap-[12px]'>
                        <h3 className='text-base'>Status:</h3>
                        <h3 className='text-base'>Time:</h3>
                    </div>
                    <div className='container flex-col my-auto gap-[12px]'>
                        <div className='container gap-[8px]'>
                            <div className='indicator approve'/>
                            <h3 className='text-base'>Approved</h3>
                        </div>
                        <h3 className='text-base'>16:25</h3>
                    </div>
                </div>
            </div>
                </>
            }

            {
                ((role==='doctor' || role === 'staff') && subpage!== "home") && 
                <>
                <div className='card gap-[48px]'>
                <div className='my-auto'>
                    <h4 className='text-red-600'>October</h4>
                    <h1 className='text-[48px] leading-[48px] font-medium'>28</h1>
                </div>
                <div className='container gap-[24px]'>
                    <div className='container flex-col text-grey-700 my-auto gap-[12px]'>
                        <h3 className='text-base'>Status:</h3>
                        <h3 className='text-base'>Time:</h3>
                    </div>
                    <div className='container flex-col my-auto gap-[12px]'>
                        <div className='container gap-[8px]'>
                            <div className='indicator approve'/>
                            <h3 className='text-base'>Approved</h3>
                        </div>
                        <h3 className='text-base'>16:25</h3>
                    </div>
                </div>
            </div>
            <div className='card gap-[48px]'>
                <div className='my-auto'>
                    <h4 className='text-red-600'>October</h4>
                    <h1 className='text-[48px] leading-[48px] font-medium'>28</h1>
                </div>
                <div className='container gap-[24px]'>
                    <div className='container flex-col text-grey-700 my-auto gap-[12px]'>
                        <h3 className='text-base'>Status:</h3>
                        <h3 className='text-base'>Time:</h3>
                    </div>
                    <div className='container flex-col my-auto gap-[12px]'>
                        <div className='container gap-[8px]'>
                            <div className='indicator approve'/>
                            <h3 className='text-base'>Approved</h3>
                        </div>
                        <h3 className='text-base'>16:25</h3>
                    </div>
                </div>
            </div>
            <div className='card gap-[48px]'>
                <div className='my-auto'>
                    <h4 className='text-red-600'>October</h4>
                    <h1 className='text-[48px] leading-[48px] font-medium'>28</h1>
                </div>
                <div className='container gap-[24px]'>
                    <div className='container flex-col text-grey-700 my-auto gap-[12px]'>
                        <h3 className='text-base'>Status:</h3>
                        <h3 className='text-base'>Time:</h3>
                    </div>
                    <div className='container flex-col my-auto gap-[12px]'>
                        <div className='container gap-[8px]'>
                            <div className='indicator approve'/>
                            <h3 className='text-base'>Approved</h3>
                        </div>
                        <h3 className='text-base'>16:25</h3>
                    </div>
                </div>
            </div>
            <div className='card gap-[48px]'>
                <div className='my-auto'>
                    <h4 className='text-red-600'>October</h4>
                    <h1 className='text-[48px] leading-[48px] font-medium'>28</h1>
                </div>
                <div className='container gap-[24px]'>
                    <div className='container flex-col text-grey-700 my-auto gap-[12px]'>
                        <h3 className='text-base'>Status:</h3>
                        <h3 className='text-base'>Time:</h3>
                    </div>
                    <div className='container flex-col my-auto gap-[12px]'>
                        <div className='container gap-[8px]'>
                            <div className='indicator approve'/>
                            <h3 className='text-base'>Approved</h3>
                        </div>
                        <h3 className='text-base'>16:25</h3>
                    </div>
                </div>
            </div>
                </>
            }
        </div>
        {(role==='doctor' || role === 'staff') &&
            <button className='tertiary'>See more</button>
        }
    </div>
  )
}

export default Appointments