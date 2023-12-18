import React from 'react'

function Appointment({appointment}) {
    const months = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
      ];
    const statuses = ['Waiting','Rejected','Approved']
    const month = months[Number(appointment?.date.split('-')[1] - 1)]
    const day = appointment?.date.split('-')[2]
    const status = statuses[appointment?.status]
    const time = appointment?.time.slice(0,5)
    console.log(month)
  return (
    <div className='card gap-[48px]'>
                <div className='my-auto'>
                    <h4 className='text-red-600'>{month}</h4>
                    <h1 className='text-[48px] leading-[48px] font-medium'>{day}</h1>
                </div>
                <div className='container gap-[24px]'>
                    <div className='container flex-col text-grey-700 my-auto gap-[12px]'>
                        <h3 className='text-base'>Status:</h3>
                        <h3 className='text-base'>Time:</h3>
                    </div>
                    <div className='container flex-col my-auto gap-[12px]'>
                        <div className='container gap-[8px]'>
                            <div className={`indicator ${status}`}/>
                            <h3 className='text-base'>{status}</h3>
                        </div>
                        <h3 className='text-base'>{time}</h3>
                    </div>
                </div>
    </div>
  )
}

export default Appointment